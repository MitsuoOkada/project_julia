<?php
use Sunra\PhpSimple\HtmlDomParser;
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
		$query = Input::post('query');
                $url = 'https://www.googleapis.com/customsearch/v1';
                $getfield = '?q='.urlencode('site:2ch.net intext:'.$query).'&key=AIzaSyA4g6XLll8Uvep9WCrr3Gyqf5IIXuhWj3A&cx=008003594174819856019:jyycf2iomk4';
                $json = json_decode(file_get_contents($url.$getfield));

		//検索結果からHTMLを取得
		$items = array();
		$j = 0;
		foreach($json->items as $item) {
			//URLの一番後ろの/の後ろを除外
			$link = $item->link;
			$width = strrpos($link, '/') + 1;
			$link = substr($link, 0, $width);

			//HTMLからdd要素の配列を取得
			$html = HtmlDomParser::file_get_html($link);
			$thread = $html->find('.thread', 0);
			if($thread == false) {
				break;
			}
			$dds = $thread->find('dd');
			//ddの中身から検索する
			$i = 1;
			foreach($dds as $dd) {
				$text = (string)$dd->plaintext;
				//検索にヒットしたらオブジェクト作成
				$pos = stripos($text, $query);
				if($pos !== false) {
					$items[] = array(
						'link' => $link.(string)$i,
						'title' => $item->title,
						'snippet' => $text
					);
					$j++;
				}
				if($j === 10) {
					break 2;
				}
				$i++;
			}
			$html->clear();
		}

                //検索結果の設定
                $data["items"] = $items;

		$data["subnav"] = array('result'=> 'active' );
		$this->template->title = 'Apitest/2ch &raquo; Result';
		$this->template->content = View::forge('apitest/2ch/result', $data);
	}

}
