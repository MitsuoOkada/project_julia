<?php

class Controller_Apitest_2ch extends Controller_Template
{

	public function action_search()
	{
		$data["subnav"] = array('search'=> 'active' );
		$this->template->title = 'Apitest/2ch &raquo; Search';
		$this->template->content = View::forge('apitest/2ch/search', $data);
	}

	public function action_result()
	{
                $url = 'https://www.googleapis.com/customsearch/v1';
                $getfield = '?q='.urlencode(Input::post('query')).'&key=AIzaSyA4g6XLll8Uvep9WCrr3Gyqf5IIXuhWj3A&cx=008003594174819856019:m2g-hi403ty';
                $json = json_decode(file_get_contents($url.$getfield));

                //検索結果の設定
                $data["items"] = $json->items;

		$data["subnav"] = array('result'=> 'active' );
		$this->template->title = 'Apitest/2ch &raquo; Result';
		$this->template->content = View::forge('apitest/2ch/result', $data);
	}

}
