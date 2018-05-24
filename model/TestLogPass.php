<?php

// Авторизация пользователя

namespace model;

use \mysqli;
use \Exception;

class TestLogPass
{
	protected
        $login,
        $pass,
        $db;

	public function __construct($login, $pass)
	{
		$this->login = $login;
		$this->pass = $pass;
	}
	public function ConnectDB() // Подключение к базе
	{
		@ $this->db = new mysqli(Constant::DBHOST, Constant::DBUSER, Constant::DBPASS);
		if (!$this->db->connect_errno) {
			$this->db->set_charset('utf8mb4');
			$this->db->select_db("base_betaphase");
		} else {
			throw new Exception('<span style="color: red"><b>К сожалению в данный момент вход в личный кабинет невозможен.</b></span><br>');
	  		}
	}
	public function Query() // Запрос в базу
	{
	    $this->ConnectDB();
		$this->login = $this->db->real_escape_string($this->login);
		$query = "SELECT `user_password` FROM `users` WHERE `user_login`='$this->login'";
		if ($result = $this->db->query($query)) {
			if ($password = $result->fetch_object()) {
				if ($this->pass == $password->user_password) {
					$result->close();
					$this->db->close();
					return TRUE;
				} else {
					$result->close();
					$this->db->close();
					return FALSE;
					}
			} else {
				$result->close();
				$this->db->close();
				return FALSE;
			}
		}
	}
}