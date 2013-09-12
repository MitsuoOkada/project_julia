<?php

class Model_Statement extends \Model
{
	protected static $_properties = array(
		'id',
		'source_site',
		'title',
		'body',
		'url',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);
	protected static $_table_name = 'statements';

	public static function save($record) {
		return DB::insert(self::$_table_name)->set($record)->execute();
	}

}
