<?php

class Controller_API_Posts extends Abstract_Controller_API
{
	public function action_get_collection()
	{
		$mapper = new Mapper_Post(Database::instance());
		$posts = $mapper->find_all();

		$data = array();
		foreach ($posts as $post)
		{
			$data[] = $post->as_array();
		}

		$this->response->body(json_encode($data));
	}

	public function action_get_entity()
	{
		$mapper = new Mapper_Post(Database::instance());
		$post = $mapper->find($this->request->param('id'));

		if ( ! $post)
		{
			// @TODO: Exception
			$this->response->body(json_encode(array('error' => 'post not found')));
		}
		else
		{
			$this->response->body(json_encode($post->as_array()));
		}
	}

	public function action_post_collection()
	{
		$mapper = new Mapper_Post(Database::instance());

		$post = new Model_Post(json_decode($this->request->body(), TRUE));
		$mapper->insert($post);

		$this->response->body(json_encode($post->as_array()));
	}

	public function action_put_entity()
	{
		$this->response->body(json_encode(array('error' => 'Can\'t update posts')));
	}
}
