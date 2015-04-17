<?php namespace App\Http\Controllers;

use App\Task;
use App\CompanyMaster;
use App\ProjectMaster;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Utility;
use Debugbar;

class TasksController extends Controller {

	protected $task;
	
	/**
     * @var ProjectMaster
     */
    protected $projectMaster;

	/**
     * @var CompanyMaster
     */
    protected $companyMaster;

    /**
     * @param Article $article
     */
    public function __construct(Task $task, ProjectMaster $projectMaster, CompanyMaster $companyMaster)
    {
		$this->task          = $task;
        $this->projectMaster = $projectMaster;
		$this->companyMaster = $companyMaster;
		
		//CSRF対策は自動でやってくれるようだ

    }
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$deleted = '';
		if(\Session::has('tdRegist')){
			$deleted = '削除が完了しました';
			\Session::forget('tdRegist');
		}
		$tasks = $this->task->getTasks();
		
		return view('task.index')->with(compact('tasks', 'deleted'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$task = $this->task->getTask($id);
		if(empty($task)){ 
			abort(404, \Lang::get('message.taskNotFound'));
		}
		
		//登録完了時のメッセージ作成
		$registed = '';
		if(\Session::has('tcRegist')){
			$tkRegist = \Session::get('tcRegist');
			if($tkRegist == $id){
				$registed = '登録が完了しました'; 
			}
			\Session::forget('tcRegist');
			
		} else if(\Session::has('teRegist')){
			$tkRegist = \Session::get('teRegist');
			if($tkRegist == $id){
				$registed = '変更が完了しました';
			}
			\Session::forget('teRegist');
		}
		
		return view('task.show')->with(compact('task', 'registed'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createInput(Request $request)
	{
		// バリデーションエラー時と確認画面から戻る時の入力値保持
		$tcFormData = $request->old();
		if(\Session::has('tcFormData') === true && $request->server('HTTP_REFERER') == route('tasks/createConfirm')){
			//確認画面から戻った場合 セッションから取得した値をモデルにセットし直す
			$tcFormData = \Session::get('tcFormData');
		} else {
			 \Session::forget('tcFormData');
		}
		
		$data = new Task();
		$data->fill($tcFormData);
			
		return $this->_renderCreateInput($data);
	}
	
	/**
	 * 新規登録 確認画面表示
	 * 
	 * @return $response
	 */
	public function createConfirm(Requests\CreateTaskRequest $request)
	{
		$data = $request->all();
		
		//初期表示判定
		if(empty($data)){
			return $this->_renderCreateInput();
		}else{
			if(empty($data['priority']) === true){
				$data['priority'] = 999;
			}
			\Session::put('tcFormData', $data);
			
			//表示用に名前を取得
			$data['company_id'] = $this->companyMaster->getCompanyName($data['company_id']);
			$data['project_id'] = $this->projectMaster->getProjectName($data['project_id']);
			
			return view('task.createConfirm')->with(compact('data'));
		}
	}
	
	/**
	 * 新規登録 登録処理
	 *
	 * @return Response
	 */
	public function createRegist()
	{
		$data = \Session::get('tcFormData');

		//初期表示判定
		if(empty($data)){
			return $this->_renderCreateInput();
		} else {
			//登録処理
			if($this->task->createTask($data) === false){
				abort(500);
			}
			\Session::forget('tcFormData');
			
			//登録したタスクの取得
			$saved = $this->task->getTaskByProjectAndNameAndLimit($data);
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('tcRegist', $saved->id);
			
			return redirect()->route("tasks/show", $saved->id);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editInput(Request $request, $id)
	{
		\Session::put('teId', $id);
		
		//フォームデータの取得
		$teFormData = $request->old();
		if(\Session::has('teFormData') === true && $request->server('HTTP_REFERER') == route('tasks/editConfirm')){
			$teFormData = \Session::get('teFormData');
		}
		
		if(empty($teFormData)) {
			//フォームデータがなければDBから取得
			$data = $this->task->getTask($id);
			if(empty($data)){ 
				abort(404, \Lang::get('message.taskNotFound'));
			}
			\Session::forget('tcFormData');
		} else {
			//フォームのデータをモデルにセットし直す
			$data = new Task();
			$data->fill($teFormData);
		}
		
		//
		$data->setAttribute('company_id', $data->projectMasters->company_id);
		
		$companies = $this->companyMaster->getCompanyList();
		Utility::reflexiveEscape($companies);
		
		$projects = $this->projectMaster->getProjectListByCompany($data->company_id);
		Utility::reflexiveEscape($projects);
		
		return view('task.editInput')->with(compact('companies', 'projects', 'data'));
	}

	/**
	 * 編集 確認画面
	 */
	public function editConfirm(Requests\CreateTaskRequest $request)
	{
		$data = $request->all();
		
		//初期表示判定
		if(empty($data)){
			return redirect()->route("tasks/index");
		}else{
			if(empty($data['priority']) === true){
				$data['priority'] = 999;
			}
			\Session::put('teFormData', $data);
			
			//表示用に名前を取得
			$data['company_id'] = $this->companyMaster->getCompanyName($data['company_id']);
			$data['project_id'] = $this->projectMaster->getProjectName($data['project_id']);
			$data['id'] = \Session::get('teId');
			
			return view('task.editConfirm')->with(compact('data'));
		}
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editRegist()
	{
		$data = \Session::get('teFormData');
		$id = \Session::get('teId');

		//初期表示判定
		if(empty($data)){
			return redirect()->route("tasks/index");
		}else{
			//更新処理
			if($this->task->updateTask($id, $data) === false){
				abort(500);
			}
			\Session::forget('teFormData');
			\Session::forget('teId');
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('teRegist', $id);
			
			return redirect()->route("tasks/show", $id);

		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteConfirm($id)
	{
		\Session::put('tdId', $id);
		$task = $this->task->getTask($id);
		if(empty($task)){ 
			abort(404, \Lang::get('message.taskNotFound'));
		}
		
		$data = $task->toArray();
		$data['company_id'] = $this->companyMaster->getCompanyName($task->projectMasters->company_id);
		$data['project_id'] = $this->projectMaster->getProjectName($data['project_id']);

		return view('task.deleteConfirm')->with(compact('data'));
	}
	
	/**
	 * 削除処理
	 */
	public function delete()
	{
		$id = \Session::get('tdId');

		//初期表示判定
		if(\Session::has('tdId') === false){
			return redirect()->route("tasks/index");
		}else{
			$id = \Session::get('tdId');
			
			//登録処理
			if($task = $this->task->deleteTask($id) === false){
				abort(500);
			}
			\Session::forget('tdId');
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('tdRegist', $id);
			
			return redirect()->route("tasks/index");
		}
	}
	
	/**
	 * ajax用プロジェクトリスト取得
	 */
	public function getProjectList(Request $request)
	{
		$id = $request->id;
		$list = array();
		if(is_null($id) === false){
			$tmp = $this->projectMaster->getProjectListByCompany($id);
			foreach($tmp as $key => $val){
				$arr['id'] = $key;
				$arr['name'] = $val;
				$list[] = $arr;
			}
		}
		
		return \Response::json($list);
	}
	
	/**
	 * 新規登録 入力画面render処理
	 * 
	 * @param type $data
	 * @return type 
	 */
	private function _renderCreateInput($data = null)
	{
		$companies = $this->companyMaster->getCompanyList();
		Utility::reflexiveEscape($companies);
		
		$projects = array();
		if(isset($data->company_id) !== false){
			//確認画面から戻った場合 セッションから取得した値をモデルにセットし直す
			$projects = $this->projectMaster->getProjectListByCompany($data->company_id);
		} else {
			$projects = $this->projectMaster->getProjectListByCompany(1);
		}
		Utility::reflexiveEscape($projects);
		
		return view('task.createInput')->with(compact('companies', 'projects', 'data'));
	}

}
