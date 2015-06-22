<?php namespace App\Http\Controllers;

use App\Task;
use App\CompanyMaster;
use App\ProjectMaster;
use App\Holder;
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
     * @var Holder
     */
    protected $holder;
	
    /**
     * @param Article $article
     */
    public function __construct(Task $task, ProjectMaster $projectMaster, CompanyMaster $companyMaster, Holder $holder)
    {
		$this->task          = $task;
        $this->projectMaster = $projectMaster;
		$this->companyMaster = $companyMaster;
		$this->holder        = $holder;
		
		//CSRF対策は自動でやってくれるようだ

    }
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$message = '';
		if(\Session::has('tdRegist')){
			$message = '削除が完了しました';
			\Session::forget('tdRegist');
		} else if(\Session::has('pRegist')) {
			$message = 'プライオリティの更新が完了しました';
			\Session::forget('pRegist');
		}
		$tasks = $this->task->getTasks();
		
		return view('task.index')->with(compact('tasks', 'message'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$task = $this->task->getTaskWithHolder($id);
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
			//	echo "<pre>";
			//print_r($request->old());exit;
		if(\Session::has('tcFormData') === true && $request->server('HTTP_REFERER') == route('tasks/createConfirm')){
			//確認画面から戻った場合 セッションから取得した値をモデルにセットし直す
			$tcFormData = \Session::get('tcFormData');
		} else {
			 \Session::forget('tcFormData');
		}
		
		$data = new Task();
		$data->fill($tcFormData);
			
		return $this->_renderCreateInput($data, 'task.createInput');
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
			
			$this->_setNames($data);
			
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
		
		// 企業IDをオブジェクトに追加
		$data->setAttribute('company_id', $data->projectMasters->company_id);
		
		return $this->_renderCreateInput($data, 'task.editInput');
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
			
			$this->_setNames($data);
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
			
			return redirect()->route("tasks/index");

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
		$task = $this->task->getTaskWithCompanyId($id);
		if(empty($task)){ 
			abort(404, \Lang::get('message.taskNotFound'));
		}
		
		$data = $task->toArray();
		
		//期間表示判定用変数作成
		$data['dateUnfixed'] = 0;
		if(is_null($data['start']) || is_null($data['limit'])) $data['dateUnfixed'] = 1;
		
		$data['dateUnfixed'] = 0;
		$this->_setNames($data);

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
	 * プライオリティ入力
	 */
	public function priorityList()
	{
		$tasks = $this->task->getTasks();
		
		return view('task.priorityList')->with(compact('tasks'));
	}

	/**
	 * プライオリティ登録
	 */
	public function priorityRegist(Requests\UpdatePriorityRequest $request)
	{
		//登録処理
		if($this->task->updatePriorities($request->priority) === false){
			abort(500);
		}
			
		//登録完了メッセージ表示用パラメータ
		\Session::put('pRegist', true);
		
		return redirect()->route("tasks/index");

	}

	/**
	 * カレンダー表示
	 */
	public function calendar()
	{
		$tasks = $this->task->getClendarData();

		return view('task.calendar')->with('tasks', json_encode($tasks));
	}
	
	/**
	 * 新規登録 入力画面render処理
	 * 
	 * @param type $data
	 * @return type 
	 */
	private function _renderCreateInput($data = null, $template = 'task.createInput')
	{
		$companies = $this->companyMaster->getCompanyList();
		Utility::reflexiveEscape($companies);
		
		$projects = array();
		if(isset($data->company_id) !== false){
			//確認画面から戻った場合 セッションから取得した値をモデルにセットし直す
			$projects = $this->projectMaster->getProjectListByCompany($data->company_id);
			$holders = $this->holder->getHolderListById($data->holder_id);
			$data->setAttribute('holder_company_id', $this->holder->getCompanyIdById($data->holder_id));
		} else {
			$projects = $this->projectMaster->getProjectListByCompany(1);
			$holders = $this->holder->getHolderListByCompany(1);
			$data->setAttribute('holder_company_id', 1);
		}
		Utility::reflexiveEscape($projects);
		Utility::reflexiveEscape($holders);
		
		return view($template)->with(compact('companies', 'projects', 'data', 'holders'));
	}
	
	/**
	 * 確認画面各種名前取得処理
	 */
	private function _setNames(&$data)
	{
		$data['company_id'] = $this->companyMaster->getCompanyName($data['company_id']);
		$data['project_id'] = $this->projectMaster->getProjectName($data['project_id']);
		$data['holder_id'] = $this->holder->getHolderName($data['holder_id']);
	}

}
