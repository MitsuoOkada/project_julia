<?php

namespace Fuel\Tasks;

class Crawl
{

	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r crawl
	 *
	 * @return string
	 */
	public function run($args = NULL)
	{
		//twitter
		$json = \Util_Twitter::search('GMO');
		$items = $json->statuses;
		while(list($key,$value) = each($items)) {
			$record = array(
				'source_site' => 'twitter',
				'body' => $value->text,
				'url' => 'https://twitter.com/'.$value->user->screen_name,
			);
			\Model_Statement::save($record);
		}

		//google
		$json = \Util_Google::search('GMO');
		$items = $json->items;
		while(list($key,$value) = each($items)) {
                        $record = array(
                                'source_site' => 'google',
				'title' => $value->title,
                                'body' => $value->snippet,
                                'url' => $value->link,
                        );
                        \Model_Statement::save($record);
                }

		//2ch
		$items = \Util_2ch::search('GMO');
                while(list($key,$value) = each($items)) {
                        $record = array(
                                'source_site' => 'google',
                                'title' => $value['title'],
                                'body' => $value['snippet'],
                                'url' => $value['link'],
                        );
                        \Model_Statement::save($record);
                }
	}



	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r crawl:index "arguments"
	 *
	 * @return string
	 */
	public function index($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning task [Crawl:Index]";
		echo "\n-------------------------------------------\n\n";

		/***************************
		 Put in TASK DETAILS HERE
		 **************************/
	}

}
/* End of file tasks/search_crawl.php */
