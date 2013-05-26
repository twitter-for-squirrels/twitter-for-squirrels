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

	public function find($id)
	{
		$result = DB::select()
			->from('posts')
			->where('id', '=', (int) $id)
			->execute($this->_database)
			->current();

		if ( ! $result)
		{
			return NULL;
		}

		return new Model_Post($result);
	}

	public function find_all()
	{
		$results = DB::select()
			->from('posts')
			->execute($this->_database);

		$array = array();

		foreach ($results as $result)
		{
			$array[] = new Model_Post($result);
		}

		return $array;
	}

	public function find_by_user(Model_User $user) {
		$results = DB::select()
			->from('posts')
			->where('user_id', '=', $user->get('id'))
			->execute($this->_database);

		$models = array();
		foreach ($results as $result)
		{
			$models[] = new Model_Post($result);
		}

		return $models;
	}

	public function find_all_by_user_id($user_id)
	{
		$results = DB::select()
			->from('posts')
			->where('user_id', '=', (int) $user_id)
			->execute($this->_database);

		$array = array();

		foreach ($results as $result)
		{
			$array[] = new Model_Post($result);
		}

		return $array;
	}
}
