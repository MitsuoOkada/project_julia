<?php

namespace Fuel\Migrations;

class Create_statements
{
	public function up()
	{
		\DBUtil::create_table('statements', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'source_site' => array('constraint' => 20, 'type' => 'varchar'),
			'title' => array('type' => 'tinytext'),
			'body' => array('type' => 'text'),
			'url' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('statements');
	}
}