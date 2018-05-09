<?php

// Авторизация пользователя

namespace model;

class TestLogPass
{
	protected $login;
	protected $passw;
	protected $db;
	public function __construct($login, $passw)
	{
		$this->login = $login;
		$this->passw = $passw;
	}
	public function ConnectDB($host, $user, $pass) // Подключение к базе
	{
		@ $this->db = new \mysqli($host, $user, $pass);
		if (!$this->db->connect_errno) {
			$this->db->set_charset('utf8mb4');
			$this->db->select_db("base_betaphase");
		} else {
			throw new Exception('<span style="color: red"><b>К сожалению в данный момент вход в личный кабинет невозможен.</b></span><br>');
	  		}
	}
	public function Query() // Запрос в базу
	{
		$this->login = $this->db->real_escape_string($this->login);
		$query = "SELECT `user_password` FROM `users` WHERE `user_login`='$this->login'";
		if ($result = $this->db->query($query)) {
			if ($passw = $result->fetch_object()) {
				if ($this->passw == $passw->user_password) {
					$result->close();
					$this->db->close();
					return(TRUE);
				} else {
					$result->close();
					$this->db->close();
					return(FALSE);
					}		
			} else {
				$result->close();
				$this->db->close();
				return(FALSE);
			}
		}
	}
}