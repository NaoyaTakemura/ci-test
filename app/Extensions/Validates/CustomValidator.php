<?php namespace App\Extensions\Validates;

use App\ProjectMaster;

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

