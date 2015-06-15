<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

	protected $table = 'tasks';

	/**
     * createメソッド実行時に、入力を禁止するカラムの指定
     *
     * @var array
     */
     protected $guarded = array('id');
	
	/**
	 * 企業マスタとの1対1
	 * @return type
	 */
	public function projectMasters()
	{
		return $this->hasOne('App\ProjectMaster', 'id', 'project_id');
	}
	
	/**
	 * 担当者との1対1
	 * @return type
	 */
	public function holders()
	{
		return $this->hasOne('App\holder', 'id', 'holder_id');
	}
	
	/**
	 * 日付自動更新の設定解除
	 */
	public $timestamps=false;
	
	public function getTasks()
	{
		return $this->with('projectMasters', 'projectMasters.companyMasters', 'holders')
			->where('delete_flag', 0)
			->where('progress', '<', 100)
			->orderBy('priority', 'asc')
			->orderBy('limit', 'asc')
			->get();
	}
	
	public function getTask($id)
	{
		return $this->find($id);
	}
	
	public function getTaskWithCompanyId($id)
	{
		$task = $this->with('projectMasters')
			->where('id', $id)
			->get();
		
		$ret = null;
		if(count($task) > 0){
			$ret = $task[0];
			$ret->setAttribute('company_id', $ret->projectMasters->company_id);
		}
		
		return $ret;
	}
	
	public function getTaskWithHolder($id)
	{
		$task = $this->with('holders')
			->where('id', $id)
			->get();
		
		$ret = null;
		if(count($task) > 0){
			$ret = $task[0];
		}
		
		return $ret;
	}
	
	/**
	 * プライオリティ重複チェック
	 */
	public function getDuplicationPriority($data)
	{
		if(isset($data['id']) === false){
			$data['id'] = 0;
		}
		
		$ret = null;
		if($data['priority'] != 999){
			$task = $this->select('id')
				->where('priority', $data['priority'])
				->where('id', '!=', $data['id'])
				/*->where(function($q) {
					$q->where('delete_flag', 0)
					->orWhere('progress', '<', 100);
				})*/
				->where('delete_flag', 0)
				->where('progress', '<', 100)
				->get();
		
			if(count($task) > 0){
				$ret = $task[0];
			}
		}

		return $ret;
	}
	
	/**
	 * タスク作成
	 */
	public function createTask($data)
	{
		$this->fill(array(
				'project_id' => $data['project_id'],
				'title'      => $data['title'],
				'text'       => $data['text'],
				'limit'      => $data['limit'],
				'holder_id'  => $data['holder_id'],
				'priority'   => $data['priority'],
				'progress'   => $data['progress'],
			));
		return $this->save();
	}
	
	/**
	 * プロジェクト・タスク名・期限を元にタスクを取得
	 */
	public function getTaskByProjectAndNameAndLimit($data)
	{
		$task = $this->select('id')
			->where('project_id', $data['project_id'])
			->where('title', $data['title'])
			->where('limit', $data['limit'])
			->get();
		
		$ret = null;
		if(count($task) > 0){
			$ret = $task[0];
		}

		return $ret;
	}
	
	/**
	 * タスクの更新
	 */
	public function updateTask($id, $data)
	{
		$task = $this->getTask($id);
		$task->fill(array(
				'project_id' => $data['project_id'],
				'title'      => $data['title'],
				'text'       => $data['text'],
				'limit'      => $data['limit'],
				'holder_id'     => $data['holder_id'],
				'priority'   => $data['priority'],
				'progress'   => $data['progress'],
		));
		return $task->save();
	}
	
	/**
	 * タスクの削除
	 */
	public function deleteTask($id)
	{
		$task = $this->getTask($id);
		$task->fill(array(
				'delete_flag' => 1
		));
		return $task->save();
	}
}
