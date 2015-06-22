<?php namespace App\Extensions\Validates;

use App\ProjectMaster;
use App\CompanyMaster;
use App\Task;
use App\Holder;

class CustomValidator extends \Illuminate\Validation\Validator
{

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return int
     */
    public function validateJpZipCode($attribute, $value, $parameters)
    {
        return preg_match("/^[0-9\-]{7,8}+$/i", $value);
    }
	
	/**
	 * 登録済みプロジェクトとの重複チェック
	 */
	public function validateProjectDuplication($attribute, $value, $parameters)
	{
		$this->resolveDbInstance();
		
		//更新の場合は選択中のプロジェクトをチェック対象から除外
		$data['project_id'] = 0;
		if(\Session::has('peId')){
			$data['project_id'] = \Session::get('peId');
		}

		$data['company_id'] = $this->getValue('company_id');
		$data['name'] = $this->getValue('name');
		$pm = new ProjectMaster();
		
		return is_null($pm->getDuplicationProject($data));
	}
	
	/**
	 * 登録済み企業との重複チェック
	 */
	public function validateCompanyDuplication($attribute, $value, $parameters)
	{
		$this->resolveDbInstance();
		
		//更新の場合は選択中のプロジェクトをチェック対象から除外
		$data['company_id'] = 0;
		if(\Session::has('ceId')){
			$data['company_id'] = \Session::get('ceId');
		}

		$data['name'] = $this->getValue('name');
		$cm = new CompanyMaster();
		
		return is_null($cm->getDuplicationCompany($data));
	}
	
	/**
	 * タスクのプライオリティ重複チェック
	 */
	public function validateTaskPriorityDuplication($attribute, $value, $parameters)
	{
		$this->resolveDbInstance();
		
		$data['priority'] = $this->getValue('priority');
		$data['company_id'] = 0;
		if(\Session::has('teId')){
			$data['id'] = \Session::get('teId');
		}
		
		$t = new Task();
		
		return is_null($t->getDuplicationPriority($data));
	}
	
	/**
	 * 登録済み担当者との重複チェック
	 */
	public function validateHolderDuplication($attribute, $value, $parameters)
	{
		$this->resolveDbInstance();
		
		//更新の場合は選択中のプロジェクトをチェック対象から除外
		$data['holder_id'] = 0;
		if(\Session::has('heId')){
			$data['holder_id'] = \Session::get('heId');
		}

		$data['company_id'] = $this->getValue('company_id');
		$data['name'] = $this->getValue('name');
		$h = new Holder();
		
		return is_null($h->getDuplicationHolder($data));
	}

	/**
	 * 日付入力チェック
	 */
	public function validateTaskDateInput($attribute, $value, $parameters)
	{
		$start = $this->getValue('start');
		$limit = $this->getValue('limit');
		$unfixed = $this->getValue('dateUnfixed');

		if($unfixed == 0){
			if($this->validateRequired('', $start) === false or
				$this->validateRequired('', $limit) === false or
				$this->validateDateFormat('', $start, array("Y-m-d G:i")) === false or
				$this->validateDateFormat('', $limit, array("Y-m-d G:i")) === false			){
				return false;
			} 
		}
		
		return true;
	}
	
	/**
	 * Model利用手続き
	 * DBのインスタンス生成がシングルトンになっているので複数回呼んでも大丈夫
     * @param string $connection
     * @return \Illuminate\Validation\DatabasePresenceVerifier
     */
    protected function resolveDbInstance($connection = "slave")
    {
        $dbPresence = $this->container['validation.presence'];
        $dbPresence->setConnection($connection);
        return $dbPresence;
    }
}

