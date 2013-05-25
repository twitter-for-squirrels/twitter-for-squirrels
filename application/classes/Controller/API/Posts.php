<?php

class Controller_API_Posts extends Abstract_Controller_API
{
	public function action_get_collection()
	{
		$this->response->body('Getting a collection of posts');
	}

	public function action_get_entity()
	{
		$this->response->body('Getting post '.$this->request->param('id'));
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
		$this->response->body('Putting post '.$this->request->param('id'));
	}
}
