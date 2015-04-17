<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateTaskRequest extends Request {

	public function __construct()
	{
		//リダイレクト先の指定 正しい遷移をしなかった場合のリダイレクト先の設定。
		//コントローラー側よりも先にバリデーションが走るため、前ページリダイレクトされてしまう。
		//デバッグバーをONにしてあると、リダイレクト先にjsやcssが指定されることがある。
		if(\Request::server('HTTP_REFERER') != route("tasks/createInput") &&
			\Request::server('HTTP_REFERER') != route("tasks/editInput", \Session::get('teId'))){
			$this->redirect = route("tasks/index");
		}
	}
	
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'company_id'=>'required|integer',
			'project_id'=>'required|integer',
			'title'=>'required|between:1,100',
			'text'=>'between:0,3000',
			'priority'=>'integer|taskPriorityDuplication',
			'limit'=>'required|date_format:"Y-m-d G:i"',
			'progress'=>'integer|between:0,100',
		];
	}

}
