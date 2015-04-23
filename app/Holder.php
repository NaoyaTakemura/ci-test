<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Holder extends Model {

	protected $table = 'holders';
	
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
	 * 企業マスタとの1対1
	 * @return type
	 */
	public function companyMasters()
	{
		return $this->hasOne('App\CompanyMaster', 'id', 'company_id');
	}

	/**
	 * タスク保持者一覧の取得
	 */
	public function getHolders()
	{
		return $this->with('companyMasters')
			->where('delete_flag', 0)
			->get();
	}
	
	/**
	 * タスク保持者の検索
	 */
	public function getHolder($id)
	{
		return $this->find($id);
	}
	
	/**
	 * タスク保持者の登録
	 */
	public function createHolder($data)
	{
		$this->fill(array(
				'company_id' => $data['company_id'],
				'name'       => $data['name']
			));
		return $this->save();
	}
	
	/**
	 * 企業IDとタスク保持者名からタスク保持者を取得
	 */
	public function getHolderByCompanyidAndName($data)
	{
		$holder = $this->select('id')
				->where('company_id', '=', $data['company_id'])
				->where('name', '=', $data['name'])
				->orderBy('id', 'desc')
				->get();

		$ret = null;
		if(count($holder) > 0){
			$ret = $holder[0];
		}

		return $ret;
	}
	
	/**
	 * 重複タスク保持者の取得
	 * $data['holder_id']に指定されたidのプロジェクトは対象外とする。
	 */
	public function getDuplicationHolder($data)
	{
		$holder = $this->select('id')
				->where('company_id', '=', $data['company_id'])
				->where('name', '=', $data['name'])
				->where('id', '!=', $data['holder_id'])
				->orderBy('id', 'desc')
				->get();

		$ret = null;
		if(count($holder) > 0){
			$ret = $holder[0];
		}

		return $ret;
	}
	
	/**
	 * タスク保持者の更新
	 */
	public function updateHolder($id, $data)
	{
		$holder = $this->getHolder($id);
		$holder->fill(array(
			'company_id' => $data['company_id'],
			'name'       => $data['name']
		));
		return $holder->save();
	}
	
	/**
	 * タスク保持者の削除
	 */
	public function deleteHolder($id)
	{
		$holder = $this->getHolder($id);
		$holder->fill(array(
			'delete_flag' => 1
		));
		return $holder->save();
	}
	
	/**
	 * タスク保持者リストの取得
	 */
	public function getHolderListByCompany($company_id)
	{
		return $this->where('company_id', $company_id)
			->lists('name', 'id');
	}
	
	/**
	 * IDによるタスク保持者リストの取得
	 */
	public function getHolderListById($id)
	{
		// 第2引数にクロージャを渡すと whereInSub になる。whereInSub は protected で直接呼べない。
		// whereInSub の中でクロージャが実行される際、newQuery がパラメータとして渡される
		return $this->whereIn('company_id', function($query) use($id){
			// $this->newQuery()しただけのオブジェクトなので、テーブルのバインドから必要。
			$query->from($this->getTable())
				->select('company_id')
				->where('id', $id);
		})
			->lists('name', 'id');
	}
	
	/**
	 * タスク保持者名の取得
	 */
	public function getHolderName($id)
	{
		return $this->where('id', $id)
			->pluck('name');
	}
	
	/**
	 * タスク保持者の企業ID取得
	 */
	public function getCompanyIdById($id)
	{
		return $this->where('id', $id)
			->pluck('company_id');
	}
}
