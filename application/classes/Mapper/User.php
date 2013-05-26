<?php

class Mapper_User
{
	protected $_database;

	public function __construct(Database $database)
	{
		$this->_database = $database;
	}

	public function insert(Model_User $user)
	{
		$data = $user->as_array();

		unset($data['id']);

		$result = DB::insert('users', array_keys($data))
			->values($data)
			->execute($this->_database);

		$user->set('id', $result[0]);

		return $user;
	}

	public function find($id)
	{
		$result = DB::select()
			->from('users')
			->where('id', '=', $id)
			->execute($this->_database)
			->current();

		if ( ! $result)
		{
			return NULL;
		}

		return new Model_User($result);
	}

	public function find_all()
	{
		$results = DB::select()
			->from('users')
			->execute($this->_database);

		$array = array();

		foreach ($results as $result)
		{
			$array[] = new Model_User($result);
		}

		return $array;
	}
}
