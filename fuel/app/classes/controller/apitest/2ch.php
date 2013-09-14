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
                //検索結果の設定
                $data["items"] = Util_2ch::search(Input::post('query'));

		$data["subnav"] = array('result'=> 'active' );
		$this->template->title = 'Apitest/2ch &raquo; Result';
		$this->template->content = View::forge('apitest/2ch/result', $data);
	}

}
