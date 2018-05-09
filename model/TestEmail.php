<?php

namespace model;

class TestEmail
{
	protected $email;
	protected $pattern;
	
	public function __construct($email)
	{
		$this->email = $email;
		$this->pattern = '/^([a-z0-9_.-]+)@([a-z0-9-]+\.)+[a-z]{2,6}$/is';
	}
	public function Test()
	{
		return (preg_match ($this->pattern, $this->email));
	}
}