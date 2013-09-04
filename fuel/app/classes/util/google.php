<?php

class Util_Google {
	public static function search($word) {
		//取得したトークンをヘッダに付けてAPIアクセス
                $url = 'https://www.googleapis.com/customsearch/v1';
                $getfield = '?q='.urlencode($word).'&key=AIzaSyA4g6XLll8Uvep9WCrr3Gyqf5IIXuhWj3A&cx=008003594174819856019:jyycf2iomk4';
                return json_decode(file_get_contents($url.$getfield));
	}
}
