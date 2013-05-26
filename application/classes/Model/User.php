<?php

class Model_User
{
	protected $_data = array(
		'id'      => NULL,
		'username' => NULL,
	);

	public function __construct(array $data = NULL)
	{
		if ($data)
		{
			$this->_data = array_merge($this->_data, $data);
		}
	}

	public function get($key)
	{
		return $this->_data[$key];
	}

	public function set($key, $value)
	{
		$this->_data[$key] = $value;

		return $this;
	}

	public function as_array()
	{
		return $this->_data;
	}
}
