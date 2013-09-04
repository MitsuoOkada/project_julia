<?php
class Controller_Apitest_Twitter extends Controller_Template
{
	//検索画面表示するだけ
	public function action_search()
	{
		$data["subnav"] = array('search'=> 'active' );
		$this->template->title = 'Apitest/twitter &raquo; Search';
		$this->template->content = View::forge('apitest/twitter/search', $data);
	}

	//検索結果表示
	public function action_result()
	{
		$json = Util_Twitter::search(Input::post('query'));

		//検索結果の設定
		$data["tweets"] = $json->statuses;

		$data["subnav"] = array('result'=> 'active' );
		$this->template->title = 'Apitest/twitter &raquo; Result';
		$this->template->content = View::forge('apitest/twitter/result', $data);
	}

}
