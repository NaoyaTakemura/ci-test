<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateHolderRequest extends Request {

	public function __construct()
	{
		//リダイレクト先の指定 正しい遷移をしなかった場合のリダイレクト先の設定。
		//コントローラー側よりも先にバリデーションが走るため、前ページリダイレクトされてしまう。
		//デバッグバーをONにしてあると、リダイレクト先にjsやcssが指定されることがある。
		if(\Request::server('HTTP_REFERER') != route("holders/createInput") &&
			\Request::server('HTTP_REFERER') != route("holders/editInput", \Session::get('heId'))){
			$this->redirect = route("holders/index");
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
			'name'=>'required|between:1,50|holderDuplication'
		];
	}
	
	/**
	 * カスタムバリデーションエラーメッセージ定義
	 * 言語ファイル（resources/lang/{言語}/validation.php）に定義するが、ここでも以下のように定義可能
	 * @return type
	 */
	/*public function messages()
    {
        return [
            'name.jp_zip_code' => ':attributeを正しく入力してね'
        ];
    }*/

}
