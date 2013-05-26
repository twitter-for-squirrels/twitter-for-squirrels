<?php

class Controller_API_Posts extends Abstract_Controller_API
{
	public function before()
	{
		parent::before();

		$this->response->headers('content-type', 'application/json');
	}

	public function action_get_collection()
	{
		$mapper = new Mapper_Post(Database::instance());

		if ($this->request->query('user_id'))
		{
			$posts = $mapper->find_all_by_user_id($this->request->query('user_id'));
		}
		else
		{
			$posts = $mapper->find_all();
		}

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
			throw new HTTP_Exception_404("That post does not exist");
		}
		else
		{
			$this->response->body(json_encode($post->as_array()));
		}
	}

	public function action_post_collection()
	{
		$this->response->body(json_encode(array('error' => 'Can\'t add posts this way!')));
	}

	public function action_post_entity()
	{
		$this->_handle_unsupported_verb();
	}

	public function action_put_collection()
	{
		$this->_handle_unsupported_verb();
	}

	public function action_put_entity()
	{
		$this->_handle_unsupported_verb();
	}

	public function action_delete_collection()
	{
		$this->_handle_unsupported_verb();
	}

	public function action_delete_entity()
	{
		$this->_handle_unsupported_verb();
	}

	protected function _handle_unsupported_verb()
	{
		$this->response->body(json_encode(array('error' => 'Can\'t do that')));
	}
}
