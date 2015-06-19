<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMaster extends Model {

	protected $table = 'project_masters';
	
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
	 * プロジェクト一覧の取得
	 */
	public function getProjects()
	{
		return $this->with('companyMasters')
			->where('delete_flag', 0)
			->get();
	}
	
	/**
	 * プロジェクトの検索
	 */
	public function getProject($id)
	{
		return $this->find($id);
	}
	
	/**
	 * プロジェクトの登録
	 */
	public function createProject($data)
	{
		$this->fill(array(
				'company_id' => $data['company_id'],
				'name'       => $data['name'],
				'color'      => $data['color']
			));
		return $this->save();
	}
	
	/**
	 * 企業IDとプロジェクト名からプロジェクトを取得
	 */
	public function getProjectByCompanyidAndName($data)
	{
		$project = $this->select('id')
				->where('company_id', '=', $data['company_id'])
				->where('name', '=', $data['name'])
				->orderBy('id', 'desc')
				->get();

		$ret = null;
		if(count($project) > 0){
			$ret = $project[0];
		}

		return $ret;
	}
	
	/**
	 * 重複企業の取得
	 * $data['project_id']に指定されたidのプロジェクトは対象外とする。
	 */
	public function getDuplicationProject($data)
	{
		$project = $this->select('id')
				->where('company_id', '=', $data['company_id'])
				->where('name', '=', $data['name'])
				->where('id', '!=', $data['project_id'])
				->orderBy('id', 'desc')
				->get();

		$ret = null;
		if(count($project) > 0){
			$ret = $project[0];
		}

		return $ret;
	}
	
	/**
	 * プロジェクトの更新
	 */
	public function updateProject($id, $data)
	{
		$project = $this->getProject($id);
		$project->fill(array(
			'company_id' => $data['company_id'],
			'name'       => $data['name'],
			'color'      => $data['color']
		));
		return $project->save();
	}
	
	/**
	 * プロジェクトの削除
	 */
	public function deleteProject($id)
	{
		$project = $this->getProject($id);
		$project->fill(array(
			'delete_flag' => 1
		));
		return $project->save();
	}
	
	/**
	 * プロジェクトリストの取得
	 */
	public function getProjectListByCompany($company_id)
	{
		return $this->where('company_id', $company_id)
			->lists('name', 'id');
	}
	
	/**
	 * プロジェクト名の取得
	 */
	public function getProjectName($id)
	{
		return $this->where('id', $id)->pluck('name');
	}
}
