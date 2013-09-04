<?php

class Util_Twitter {
	//認証情報
        private static $authorization = '';
        //トークン
        private static $token = '';

        //トークン取得
        private static function getToken() {
                if('' != self::$token) {
                        return self::$token;
                }

                //認証情報作成
                if('' == self::$authorization) {
                        self::$authorization = base64_encode(urlencode('IPsSu0WJEDGr4xBwHZ3jHQ').':'.urlencode('XzBcN3qYbqzPFKVvtNEfnveimBW2bdwAOSLLV6ixU'));
                }

                //認証情報を使ってトークンの取得
                $url = 'https://api.twitter.com/oauth2/token';
                $header = array(
                        'Authorization: Basic '.self::$authorization,
                        'Content-Type: application/x-www-form-urlencoded;charset=UTF-8'
                );
                $body = array('grant_type' => 'client_credentials');
                $options = array('http' => array(
                        'method' => 'POST',
                        'header' => implode("\r\n", $header),
                        'content' => http_build_query($body)
                ));
                $json = json_decode(file_get_contents($url, false, stream_context_create($options)));
                self::$token = $json->access_token;
                return self::$token;
        }

	public static function search($word) {
		//取得したトークンをヘッダに付けてAPIアクセス
                $url = 'https://api.twitter.com/1.1/search/tweets.json';
                $getfield = '?q='.urlencode($word);
                $header = array('Authorization: Bearer '.self::getToken());
                $options = array('http' => array(
                        'method' => 'GET',
                        'header' => implode("\r\n", $header)
                ));
                return json_decode(file_get_contents($url.$getfield, false, stream_context_create($options)));
	}
}
