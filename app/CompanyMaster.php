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
}
