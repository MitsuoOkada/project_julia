<?php

class Util_2ch {
	public static function search($word) {
		//取得したトークンをヘッダに付けてAPIアクセス
                $url = 'https://www.googleapis.com/customsearch/v1';
                $getfield = '?q='.urlencode('site:2ch.net '.$word).'&key=AIzaSyA4g6XLll8Uvep9WCrr3Gyqf5IIXuhWj3A&cx=008003594174819856019:jyycf2iomk4';
                $json = json_decode(file_get_contents($url.$getfield));

		//検索結果からHTMLを取得
                $items = array();
                $j = 0;
                if(isset($json->items)) {
                        foreach($json->items as $item) {
                                //URLの一番後ろの/の後ろを除外
                                $link = $item->link;
                                $width = strrpos($link, '/') + 1;
                                $link = substr($link, 0, $width);
                                
				//HTMLからdd要素の配列を取得
				$html = mb_convert_encoding(file_get_contents($link), 'HTML-ENTITIES', 'ASCII, JIS, UTF-8, EUC-JP, SJIS');
				$dom = new DOMDocument();
				libxml_use_internal_errors(true);
				$dom->loadHTML($html);
                                $dds = $dom->getElementsByTagName('dd');

                                //ddの中身から検索する
                                $i = 1;
                                foreach($dds as $dd) {
                                        $text = $dd->nodeValue;
                                        //検索にヒットしたらオブジェクト作成
                                        $pos = stripos($text, $word);
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
                        }
                }
		return $items;
	}
}
