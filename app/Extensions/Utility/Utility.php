<?php namespace App\Extensions\Utility;

class Utility
{
	/**
	 * 再帰エスケープ
	 */
	public static function reflexiveEscape(&$data)
	{
		array_walk_recursive($data, function(&$item, $key){ $item = htmlspecialchars($item, ENT_QUOTES); });
	}
}

