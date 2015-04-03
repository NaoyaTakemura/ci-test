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
	 * 日付自動更新の設定解除
	 */
	public $timestamps=false;
}
