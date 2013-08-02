<?php
//Application-only authenticationでTwitter検索
class Controller_Apitest_Twitter extends Controller_Template
{
	//検索画面表示するだけ
	public function action_search()
	{
		$data["subnav"] = array('search'=> 'active' );
		$this->template->title = 'Apitest/twitter &raquo; Search';
		$this->template->content = View::forge('apitest/twitter/search', $data);
	}

	//認証情報
	private static $authorization = '';
	//トークン
	private static $token = '';

	//トークン取得
	private function getToken() {
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

	//検索結果表示
	public function action_result()
	{
		//取得したトークンをヘッダに付けてAPIアクセス
		$url = 'https://api.twitter.com/1.1/search/tweets.json';
		$getfield = '?q='.urlencode(Input::post('query'));
		$header = array('Authorization: Bearer '.$this->getToken());
		$options = array('http' => array(
			'method' => 'GET',
			'header' => implode("\r\n", $header)
		));
		$json = json_decode(file_get_contents($url.$getfield, false, stream_context_create($options)));
		
		//検索結果の設定
		$tweets = array();
		foreach ($json->statuses as $tweet) {
			$tweets[] = $tweet;
		}

		$data["tweets"] = $tweets;

		$data["subnav"] = array('result'=> 'active' );
		$this->template->title = 'Apitest/twitter &raquo; Result';
		$this->template->content = View::forge('apitest/twitter/result', $data);
	}

}
