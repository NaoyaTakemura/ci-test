<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyMaster extends Model {

	protected $table = 'company_masters';

	/**
     * createメソッド実行時に、入力を禁止するカラムの指定
     *
     * @var array
     */
     protected $guarded = array('id');
	 
	/**
	 * 日付自動更新の設定解除
	 */
	public $timestamps=false;
	
	/**
	 * 担当者との1対多
	 * @return type
	 */
	/*public function holders()
	{
		return $this->hasMany('App\Holder', 'company_id', 'id');
	}*/
	
	/**
	 * 企業一覧の取得
	 */
	public function getCompanies()
	{
		return $this->where('delete_flag', 0)->get();
	}

	/**
	 * 企業の取得
	 */
	public function getCompany($id)
	{
		return $this->find($id);
	}
	
	/**
	 * 企業リストの取得
	 */
	public function getCompanyList()
	{
		return $this->lists('name', 'id');
	}

	/**
	 * 企業名の取得
	 */
	public function getCompanyName($id)
	{
		return $this->where('id', $id)->pluck('name');
	}
	
	/**
	 * 企業の重複チェック
	 */
	public function getDuplicationCompany($data)
	{
		$company = $this->select('id')
				->where('name', '=', $data['name'])
				->where('id', '!=', $data['company_id'])
				->orderBy('id', 'desc')
				->get();

		$ret = null;
		if(count($company) > 0){
			$ret = $company[0];
		}

		return $ret;
	}
	
	/**
	 * 企業登録
	 */
	public function createCompany($data)
	{
		$this->fill(array(
				'name'       => $data['name']
			));
		return $this->save();
	}
	
	/**
	 * 名前による企業検索
	 */
	public function getCompanyByName($name)
	{
		$company = $this->where('name', $name)->get();
		
		$ret = null;
		if(count($company) > 0){
			$ret = $company[0];
		}

		return $ret;
	}
	
	/**
	 * 企業の更新
	 */
	public function updateCompany($id, $data)
	{
		$company = $this->getCompany($id);
		$company->fill(array(
			'name'       => $data['name']
		));
		return $company->save();
	}
	
	/**
	 * 企業の削除
	 */
	public function deleteCompany($id)
	{
		$company = $this->getCompany($id);
		$company->fill(array(
			'delete_flag' => 1
		));
		return $company->save();
	}
}
