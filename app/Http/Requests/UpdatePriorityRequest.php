<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePriorityRequest extends Request {

	public function __construct()
	{
		//リダイレクト先の指定 正しい遷移をしなかった場合のリダイレクト先の設定。
		//コントローラー側よりも先にバリデーションが走るため、前ページリダイレクトされてしまう。
		//デバッグバーをONにしてあると、リダイレクト先にjsやcssが指定されることがある。
		if(\Request::server('HTTP_REFERER') != route("tasks/priorityList")){
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
			
		];
	}

}
