<?php namespace App\Http\Controllers;

use App\CompanyMaster;
use App\ProjectMaster;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Utility;
use Debugbar;

class ProjectMastersController extends Controller {

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
    public function __construct(ProjectMaster $projectMaster, CompanyMaster $companyMaster)
    {
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
		if(\Session::has('pdRegist')){
			$deleted = '削除が完了しました';
			\Session::forget('pdRegist');
		}
		$projects = $this->projectMaster->getProjects();
		return view('projectMaster.index')->with(compact('projects', 'deleted'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = $this->projectMaster->getProject($id);
		if(empty($project)){ 
			abort(404, \Lang::get('message.projectNotFound'));
		}
		
		//登録完了時のメッセージ作成
		$registed = '';
		if(\Session::has('pcRegist')){
			$pkRegist = \Session::get('pcRegist');
			if($pkRegist == $id){
				$registed = '登録が完了しました'; 
			}
			\Session::forget('pcRegist');
			
		} else if(\Session::has('peRegist')){
			$pkRegist = \Session::get('peRegist');
			if($pkRegist == $id){
				$registed = '変更が完了しました';
			}
			\Session::forget('peRegist');
		}
		
		return view('projectMaster.show')->with(compact('project', 'registed'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createInput(Request $request)
	{
		// バリデーションエラー時と確認画面から戻る時の入力値保持
		$pcFormData = $request->old();
		if(\Session::has('pcFormData') === true && $request->server('HTTP_REFERER') == route('projectMasters/createConfirm')){
			//確認画面から戻った場合 セッションから取得した値をモデルにセットし直す
			$pcFormData = \Session::get('pcFormData');
		} else {
			 \Session::forget('pcFormData');
		}
		
		$data = new ProjectMaster();
		$data->fill($pcFormData);

		return $this->_renderCreateInput($data, 'projectMaster.createInput');
	}

	/**
	 * 新規登録 確認画面表示
	 * 
	 * @return $response
	 */
	public function createConfirm(Requests\CreateProjectRequest $request)
	{
		$data = $request->all();
		
		//初期表示判定
		if(empty($data)){
			return $this->_renderCreateInput();
		}else{
			\Session::put('pcFormData', $data);
			$data['company_id'] = $this->companyMaster->getCompanyName($data['company_id']);
			return view('projectMaster.createConfirm')->with(compact('data'));
		}
	}
	
	/**
	 * 新規登録 登録処理
	 *
	 * @return Response
	 */
	public function createRegist()
	{
		$data = \Session::get('pcFormData');

		//初期表示判定
		if(empty($data)){
			return $this->_renderCreateInput();
		} else {
			//登録処理
			if($this->projectMaster->createProject($data) === false){
				abort(500);
			}
			\Session::forget('pcFormData');
			
			//登録したプロジェクトの取得
			$saved = $this->projectMaster->getProjectByCompanyidAndName($data);
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('pcRegist', $saved->id);
			
			return redirect()->route("projectMasters/show", $saved->id);
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
		\Session::put('peId', $id);
		
		//フォームデータの取得
		$peFormData = $request->old();
		if(\Session::has('peFormData') === true && $request->server('HTTP_REFERER') == route('projectMasters/editConfirm')){
			$peFormData = \Session::get('peFormData');
		}
		
		if(empty($peFormData)) {
			//フォームデータがなければDBから取得
			$project = $this->projectMaster->getProject($id);
			if(empty($project)){ 
				abort(404, \Lang::get('message.projectNotFound'));
			}
			\Session::forget('pcFormData');
		} else {
			//フォームのデータをモデルにセットし直す
			$project = new ProjectMaster();
			$project->fill($peFormData);
		}
		
		/*$companies = $this->companyMaster->getCompanyList();

		Utility::reflexiveEscape($companies);
		return view('projectMaster.editInput')->with(compact('companies', 'project'));*/
		return $this->_renderCreateInput($project, 'projectMaster.editInput');
	}

	/**
	 * 編集 確認画面
	 */
	public function editConfirm(Requests\CreateProjectRequest $request)
	{
		$data = $request->all();
		
		//初期表示判定
		if(empty($data)){
			return redirect()->route("projectMasters/index");
		}else{
			\Session::put('peFormData', $data);
			$data['company_id'] = $this->companyMaster->getCompanyName($data['company_id']);
			$data['project_id'] = \Session::get('peId');
			return view('projectMaster.editConfirm')->with(compact('data'));
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
		$data = \Session::get('peFormData');
		$id = \Session::get('peId');

		//初期表示判定
		if(empty($data)){
			return redirect()->route("projectMasters/index");
		}else{
			//更新処理
			if($this->projectMaster->updateProject($id, $data) === false){
				abort(500);
			}
			\Session::forget('peFormData');
			\Session::forget('peId');
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('peRegist', $id);
			
			return redirect()->route("projectMasters/show", $id);

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
		\Session::put('pdId', $id);
		$project = $this->projectMaster->getProject($id);
		if(empty($project)){ 
			abort(404, \Lang::get('message.projectNotFound'));
		}
		
		return view('projectMaster.deleteConfirm')->with(compact('project'));
	}
	
	/**
	 * 削除処理
	 */
	public function delete()
	{
		$id = \Session::get('pdId');

		//初期表示判定
		if(\Session::has('pdId') === false){
			return redirect()->route("projectMasters/index");
		}else{
			$id = \Session::get('pdId');
			
			//登録処理
			if($project = $this->projectMaster->deleteProject($id) === false){
				abort(500);
			}
			\Session::forget('pdId');
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('pdRegist', $id);
			
			return redirect()->route("projectMasters/index");
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
	private function _renderCreateInput($data = null, $template = 'projectMaster.createInput')
	{
		$companies = $this->companyMaster->getCompanyList();
		Utility::reflexiveEscape($companies);
		return view($template)->with(compact('companies', 'data'));
	}

}
