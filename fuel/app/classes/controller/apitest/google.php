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
                $json = Util_Google::search(Input::post('query'));
		$items = array();
		if(isset($json->items)) {
			$items = $json->items;
		}

                //検索結果の設定
                $data["items"] = $items;

		$data["subnav"] = array('result'=> 'active' );
		$this->template->title = 'Apitest/google &raquo; Result';
		$this->template->content = View::forge('apitest/google/result', $data);
	}

}
