<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		//エラー画面にメッセージを表示するには以下のようにexceptionを補足してresponseを返す必要あり。
		//parent::renderではテンプレートにメッセージをセットしない。
		if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){
			$error = $e->getMessage();
			return response(view('errors.404')->with(compact('error')), 404);
		}
		return parent::render($request, $e);
	}

}
