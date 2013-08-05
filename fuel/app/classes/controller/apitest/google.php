<?php

class Controller_Apitest_Google extends Controller_Template
{

	public function action_search()
	{
		$data["subnav"] = array('search'=> 'active' );
		$this->template->title = 'Apitest/google &raquo; Search';
		$this->template->content = View::forge('apitest/google/search', $data);
	}

	public function action_result()
	{
		//取得したトークンをヘッダに付けてAPIアクセス
                $url = 'https://www.googleapis.com/customsearch/v1';
                $getfield = '?q='.urlencode(Input::post('query')).'&key=AIzaSyA4g6XLll8Uvep9WCrr3Gyqf5IIXuhWj3A&cx=008003594174819856019:jyycf2iomk4';
                $json = json_decode(file_get_contents($url.$getfield));

                //検索結果の設定
                $data["items"] = $json->items;

		$data["subnav"] = array('result'=> 'active' );
		$this->template->title = 'Apitest/google &raquo; Result';
		$this->template->content = View::forge('apitest/google/result', $data);
	}

}
