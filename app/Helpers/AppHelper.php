<?php
namespace App\Helpers;

class AppHelper{

	public static function createResponseJson($status_code,$status,$message,$data=null){
		$res = array(
			'statusCode'=>$status_code,
			'status'=>$status,
			'message'=>$message,
			'data'=>$data);
		return $res;

	}
}
?>