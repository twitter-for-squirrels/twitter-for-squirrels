<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('home', '')
	->defaults(array(
		'controller' => 'main',
		'action'     => 'index',
	));

Route::set('api.posts', 'api/posts(/<id>)')
	->defaults(array(
		'directory' => 'API',
		'controller' => 'Posts'
	))
	->filter(function($route, $params, $request) {
		// Checks whether this request is for a collection or entity.
		$action_on = isset($params['id']) ? 'entity' : 'collection';
		// Prefix the controller action with the request method.
		$params['action'] = $request->method().'_'.$action_on;

		return $params;
	});

Route::set('api.users', 'api/users(/<id>)')
	->defaults(array(
		'directory' => 'API',
		'controller' => 'Users'
	))
	->filter(function($route, $params, $request) {
		// Checks whether this request is for a collection or entity.
		$action_on = isset($params['id']) ? 'entity' : 'collection';
		// Prefix the controller action with the request method.
		$params['action'] = $request->method().'_'.$action_on;

		return $params;
	});

Route::set('api.userposts', 'api/users/<user_id>/posts')
	->defaults(array(
		'directory' => 'API',
		'controller' => 'UserPosts'
	))
	->filter(function($route, $params, $request) {
		// Checks whether this request is for a collection or entity.
		$action_on = isset($params['id']) ? 'entity' : 'collection';
		// Prefix the controller action with the request method.
		$params['action'] = $request->method().'_'.$action_on;

		return $params;
	});
