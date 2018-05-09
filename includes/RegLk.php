<?php
// Регистрация пользователя
class RegLogPass
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
		@ $this->db = new mysqli($host, $user, $pass);
		if (!$this->db->connect_errno)
		{
			$this->db->set_charset('utf8mb4');
			$this->db->select_db("base_betaphase");
		} else {
			throw new Exception('<span style="color: red"><b>К сожалению в данный момент регистрация невозможна.</b></span><br>');
	  		}
	}
	public function Query() // Запрос в базу
	{
		$this->login = $this->db->real_escape_string($this->login);
		$this->passw = $this->db->real_escape_string($this->passw);
		$query = "INSERT INTO `users` VALUES (NULL, '$this->login', '$this->passw');
				SELECT `user_login` FROM `users` WHERE `user_login`='$this->login';";
		if ($this->db->multi_query($query))
		{			
			if ($this->db->more_results() and $this->db->next_result())
			{
				$result = $this->db->use_result();
				$login = $result->fetch_object();
				if ($this->login == $login->user_login)
				{
					$result->close();
					$this->db->close();
					return($login->user_login);
				} else {
					$result->close();
					$this->db->close();
					return(FALSE);
					}		
			} else {
				$this->db->close();
				return(FALSE);
			}
		} else {
			throw new Exception('<span style="color: red"><b>Пользователь с таким именем уже существует!</b></span><br>');
		}
	}
}
?>