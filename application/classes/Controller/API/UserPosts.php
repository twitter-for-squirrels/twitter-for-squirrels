<?php

class Controller_API_UserPosts extends Abstract_Controller_API
{
	public function action_get_collection() {
		$user_id = $this->request->param('user_id');
		$um = new Mapper_User(Database::instance());

		$user = $um->find($user_id);
		if ( ! $user)
		{
			throw new HTTP_Exception_404('This user doesn\'t exist');
		}

		$pm = new Mapper_Post(Database::instance());
		$posts = $pm->find_by_user($user);

		$post_data = array();
		foreach ($posts as $post) {
			$post_data[] = $post->as_array();
		}

		$this->response->body(json_encode($post_data));
	}

	public function action_post_collection() {
		$um = new Mapper_User(Database::instance());

		$user = $um->find($this->request->param('user_id'));
		if ( ! $user)
		{
			throw new HTTP_Exception_404('This user doesn\'t exist');
		}

		$mapper = new Mapper_Post(Database::instance());

		$post_data = json_decode($this->request->body(), TRUE);
		$post_data['user_id'] = $user->get('id');
		$post = new Model_Post($post_data);
		$mapper->insert($post);

		$this->response->body(json_encode($post->as_array()));
	}
}
