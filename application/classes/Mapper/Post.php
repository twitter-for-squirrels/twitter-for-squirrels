<?php

class Mapper_Post
{
	protected $_database;

	public function __construct(Database $database)
	{
		$this->_database = $database;
	}

	public function insert(Model_Post $post)
	{
		$data = $post->as_array();

		unset($data['id']);

		$result = DB::insert('posts', array_keys($data))
			->values($data)
			->execute($this->_database);

		$post->set('id', $result[0]);

		return $post;
	}
}
