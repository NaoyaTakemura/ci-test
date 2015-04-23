<?php namespace App\Http\Controllers;

use App\Holder;
use App\CompanyMaster;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Utility;
use Debugbar;

class HoldersController extends Controller {

	/**
     * @var ProjectMaster
     */
    protected $holder;

	/**
     * @var CompanyMaster
     */
    protected $companyMaster;

    /**
     * @param Article $article
     */
    public function __construct(Holder $holder, CompanyMaster $CompanyMaster)
    {
        $this->holder = $holder;
		$this->companyMaster = $CompanyMaster;
		
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
		if(\Session::has('hdRegist')){
			$deleted = '削除が完了しました';
			\Session::forget('hdRegist');
		}
		$holders = $this->holder->getHolders();
		return view('holder.index')->with(compact('holders', 'deleted'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$holder = $this->holder->getholder($id);
		if(empty($holder)){ 
			abort(404, \Lang::get('message.holderNotFound'));
		}
		
		//登録完了時のメッセージ作成
		$registed = '';
		if(\Session::has('hcRegist')){
			$hkRegist = \Session::get('hcRegist');
			if($hkRegist == $id){
				$registed = '登録が完了しました'; 
			}
			\Session::forget('hcRegist');
			
		} else if(\Session::has('heRegist')){
			$hkRegist = \Session::get('heRegist');
			if($hkRegist == $id){
				$registed = '変更が完了しました';
			}
			\Session::forget('heRegist');
		}
		
		return view('holder.show')->with(compact('holder', 'registed'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createInput(Request $request)
	{
		// バリデーションエラー時と確認画面から戻る時の入力値保持
		$hcFormData = $request->old();
		if(\Session::has('hcFormData') === true && $request->server('HTTP_REFERER') == route('holders/createConfirm')){
			//確認画面から戻った場合 セッションから取得した値をモデルにセットし直す
			$hcFormData = \Session::get('hcFormData');
		} else {
			 \Session::forget('hcFormData');
		}
		
		$data = new Holder();
		$data->fill($hcFormData);
			
		return $this->_renderCreateInput($data);
	}

	/**
	 * 新規登録 確認画面表示
	 * 
	 * @return $response
	 */
	public function createConfirm(Requests\CreateHolderRequest $request)
	{
		$data = $request->all();
		
		//初期表示判定
		if(empty($data)){
			return $this->_renderCreateInput();
		}else{
			\Session::put('hcFormData', $data);
			$data['company_id'] = $this->companyMaster->getCompanyName($data['company_id']);
			return view('holder.createConfirm')->with(compact('data'));
		}
	}
	
	/**
	 * 新規登録 登録処理
	 *
	 * @return Response
	 */
	public function createRegist()
	{
		$data = \Session::get('hcFormData');

		//初期表示判定
		if(empty($data)){
			return $this->_renderCreateInput();
		} else {
			//登録処理
			if($this->holder->createHolder($data) === false){
				abort(500);
			}
			\Session::forget('hcFormData');
			
			//登録したレコードの取得
			$saved = $this->holder->getHolderByCompanyidAndName($data);
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('hcRegist', $saved->id);
			
			return redirect()->route("holders/show", $saved->id);
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
		\Session::put('heId', $id);
		
		//フォームデータの取得
		$heFormData = $request->old();
		if(\Session::has('heFormData') === true && $request->server('HTTP_REFERER') == route('holders/editConfirm')){
			$heFormData = \Session::get('heFormData');
		}
		
		if(empty($heFormData)) {
			//フォームデータがなければDBから取得
			$holder = $this->holder->getHolder($id);
			if(empty($holder)){ 
				abort(404, \Lang::get('message.holderNotFound'));
			}
			\Session::forget('hcFormData');
		} else {
			//フォームのデータをモデルにセットし直す
			$holder = new Holder();
			$holder->fill($heFormData);
		}
		
		$companies = $this->companyMaster->getCompanyList();

		Utility::reflexiveEscape($companies);
		return view('holder.editInput')->with(compact('companies', 'holder'));
	}

	/**
	 * 編集 確認画面
	 */
	public function editConfirm(Requests\CreateHolderRequest $request)
	{
		$data = $request->all();
		
		//初期表示判定
		if(empty($data)){
			return redirect()->route("holder/index");
		}else{
			\Session::put('heFormData', $data);
			$data['company_id'] = $this->companyMaster->getCompanyName($data['company_id']);
			$data['holder_id'] = \Session::get('heId');
			return view('holder.editConfirm')->with(compact('data'));
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
		$data = \Session::get('heFormData');
		$id = \Session::get('heId');

		//初期表示判定
		if(empty($data)){
			return redirect()->route("holder/index");
		}else{
			//更新処理
			if($this->holder->updateHolder($id, $data) === false){
				abort(500);
			}
			\Session::forget('heFormData');
			\Session::forget('heId');
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('heRegist', $id);
			
			return redirect()->route("holders/show", $id);

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
		\Session::put('hdId', $id);
		$holder = $this->holder->getHolder($id);
		if(empty($holder)){ 
			abort(404, \Lang::get('message.holderNotFound'));
		}
		
		return view('holder.deleteConfirm')->with(compact('holder'));
	}
	
	/**
	 * 削除処理
	 */
	public function delete()
	{
		$id = \Session::get('hdId');

		//初期表示判定
		if(\Session::has('hdId') === false){
			return redirect()->route("holder/index");
		}else{
			$id = \Session::get('hdId');
			
			//登録処理
			if($holder = $this->holder->deleteHolder($id) === false){
				abort(500);
			}
			\Session::forget('hdId');
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('hdRegist', $id);
			
			return redirect()->route("holder/index");
		}
	}
	
	/**
	 * ajax用担当者取得処理
	 */
	public function getHolderList(Request $request)
	{
		$id = $request->id;
		$list = array();
		if(is_null($id) === false){
			$tmp = $this->holder->getHolderListByCompany($id);
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
		return view('holder.createInput')->with(compact('companies', 'data'));
	}

}
