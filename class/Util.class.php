<?php
require_once(dirname(dirname(__FILE__)).'/Config.php');

class Util{
	//字符串startwith
	static function strStartWith($str, $needle){
		return strpos($str, $needle) === 0;
	}

	//字符串endwith
	static function strEndWith($str, $needle){
		$length = strlen($needle);  
		if($length == 0) {    
			return true;  
		}  
		return (substr($str, -$length) === $needle);
	}

	//向Url Post内容
	static function urlPost($url,$data,$timeout,$jsonout=false){
		$ch = curl_init ();
		$result=false;
		try{
			curl_setopt ( $ch, CURLOPT_URL,$url);
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_HEADER, 0 );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS,$data);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 5000);//设置连接超时时间
			if($timeout!=null){
				curl_setopt($ch, CURLOPT_TIMEOUT_MS,$timeout*1000);//设置超时时间
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//1将结果返回，0直接stdout
			$result=curl_exec ( $ch );
			if(curl_getinfo($ch)['http_code']/100!=2){
				$result= false;
			}
			else if($jsonout){
				$result=json_decode($result,true);
			}
		}
		catch(Exception $e){
			$result= false;
		}
		finally{
			curl_close($ch);
			unset($ch);
			return $result;
		}
	}
}
