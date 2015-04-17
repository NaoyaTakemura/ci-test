<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\CompanyMaster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Debugbar;

class CompanyMastersController extends Controller {
	
	protected $companyMaster;

	/**
	 * コンストラクタ
	 */
	public function __construct(CompanyMaster $companyMaster)
	{
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
		if(\Session::has('cdRegist')){
			$deleted = '削除が完了しました';
			\Session::forget('cdRegist');
		}
		$companies = $this->companyMaster->getCompanies();
		return view('companyMaster.index')->with(compact('companies', 'deleted'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company = $this->companyMaster->getCompany($id);
		if(empty($company)){ 
			abort(404);
		}
		
		//登録完了時のメッセージ作成
		$registed = '';
		if(\Session::has('ccRegist')){
			$ckRegist = \Session::get('ccRegist');
			if($ckRegist == $id){
				$registed = '登録が完了しました'; 
			}
			\Session::forget('ccRegist');
			
		} else if(\Session::has('ceRegist')){
			$ckRegist = \Session::get('ceRegist');
			if($ckRegist == $id){
				$registed = '変更が完了しました';
			}
			\Session::forget('ceRegist');
		}
		
		return view('companyMaster.show')->with(compact('company', 'registed'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createInput(Request $request)
	{
		// バリデーションエラー時と確認画面から戻る時の入力値保持
		$ccFormData = $request->old();

		if(\Session::has('ccFormData') === true && $request->server('HTTP_REFERER') == route('companyMasters/createConfirm')){
			//確認画面から戻った場合 セッションから取得した値をモデルにセットし直す
			$ccFormData = \Session::get('ccFormData');
		} else {
			 \Session::forget('ccFormData');
		}
		
		$data = new CompanyMaster();
		$data->fill($ccFormData);
		
		return view('companyMaster.createInput')->with(compact('data'));
	}
	
	/**
	 * 企業登録 確認画面
	 */
	public function createConfirm(Requests\CreateCompanyRequest $request)
	{
		$data = $request->all();

		//初期表示判定
		if(empty($data)){
			return redirect()->route("companyMasters/index");
		}else{
			\Session::put('ccFormData', $data);
			return view('companyMaster.createConfirm')->with(compact('data'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function createRegist()
	{
		$data = \Session::get('ccFormData');

		//初期表示判定
		if(empty($data)){
			return redirect()->route("companyMasters/index");
		} else {
			//登録処理
			if($this->companyMaster->createCompany($data) === false){
				abort(500);
			}
			\Session::forget('ccFormData');
			
			//登録したプロジェクトの取得
			$saved = $this->companyMaster->getCompanyByName($data['name']);
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('ccRegist', $saved->id);
			
			return redirect()->route("companyMasters/show", $saved->id);
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
		\Session::put('ceId', $id);
		
		//フォームデータの取得
		$ceFormData = $request->old();
		if(\Session::has('ceFormData') === true && $request->server('HTTP_REFERER') == route('companyMasters/editConfirm')){
			$ceFormData = \Session::get('ceFormData');
		}
		
		if(empty($ceFormData)) {
			//フォームデータがなければDBから取得
			$company = $this->companyMaster->getCompany($id);
			if(empty($company)){ 
				abort(404);
			}
			\Session::forget('ccFormData');
		} else {
			//フォームのデータをモデルにセットし直す
			$company = new CompanyMaster();
			$company->fill($ceFormData);
		}
		
		
		return view('companyMaster.editInput')->with(compact('company'));
	}

	/**
	 * 企業変更 確認画面
	 * @param type $id
	 */
	public function editConfirm(Requests\CreateCompanyRequest $request)
	{
		$data = $request->all();
		
		//初期表示判定
		if(empty($data)){
			return redirect()->route("companyMasters/index");
		}else{
			\Session::put('ceFormData', $data);
			$data['company_id'] = \Session::get('ceId');
			return view('companyMaster.editConfirm')->with(compact('data'));
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
		$data = \Session::get('ceFormData');
		$id = \Session::get('ceId');

		//初期表示判定
		if(empty($data)){
			return redirect()->route("companyMasters/index");
		}else{
			//更新処理
			if($this->companyMaster->updateCompany($id, $data) === false){
				abort(500);
			}
			\Session::forget('ceFormData');
			\Session::forget('ceId');
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('ceRegist', $id);
			
			return redirect()->route("companyMasters/show", $id);

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
		\Session::put('cdId', $id);
		$company = $this->companyMaster->getCompany($id);
		return view('companyMaster.deleteConfirm')->with(compact('company'));
	}
	
	/**
	 * 削除処理
	 */
	public function delete()
	{
		$id = \Session::get('cdId');

		//初期表示判定
		if(\Session::has('cdId') === false){
			return redirect()->route("companyMasters/index");
		}else{
			$id = \Session::get('cdId');
			
			//登録処理
			if($company = $this->companyMaster->deleteCompany($id) === false){
				abort(500);
			}
			\Session::forget('cdId');
			
			//登録完了メッセージ表示用パラメータ
			\Session::put('cdRegist', $id);
			
			return redirect()->route("companyMasters/index");
		}
	}

}
