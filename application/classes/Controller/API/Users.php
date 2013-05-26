<?php

class Controller_API_Users extends Abstract_Controller_API
{
	public function action_get_collection()
	{
		$mapper = new Mapper_User(Database::instance());
		$users = $mapper->find_all();

		$user_data = array();
		foreach ($users as  $user)
		{
			$user_data[] = $user->as_array();
		}

		$this->response->body(json_encode($user_data));
	}

	public function action_get_entity()
	{
		$mapper = new Mapper_User(Database::instance());
		$user = $mapper->find($this->request->param('id'));

		if ( ! $user)
		{
			throw new HTTP_Exception_404("That user does not exist.");
		}
		else
		{
			$this->response->body(json_encode($user->as_array()));
		}
	}

	public function action_post_collection()
	{
		$mapper = new Mapper_User(Database::instance());

		$user = new Model_User(json_decode($this->request->body(), TRUE));
		$mapper->insert($user);

		$this->response->status(201);
		$this->response->body(json_encode($user->as_array()));
	}

	public function action_put_entity()
	{
		$this->response->body(json_encode(array('error' => 'Can\'t update users')));
	}
}
