<?php 
	class URLHelper{
		public static function createParamLink($param){
			$url = '';
			foreach ($param as $key => $value) {
				$strParam = "$key=$value";
				$url .= (parse_url($url, PHP_URL_QUERY) ? '&' : '?').$strParam;
			}
			return $url;
		}
	}
 ?>