<?php

namespace model;

use \Exception;

spl_autoload_register();

class Authorization
{
	public
        $msg = '<span style="color: green"><b>Для входа необходимо ввести E-Mail и пароль!</b></span><br>',
        $msg_reg = '<span style="color: green"><b>Для регистрации введите E-Mail и пароль!</b></span><br>';
	
	public function Auth()
	{
		if (isset($_POST['login']) and isset($_POST['passw'])) { 					// Авторизация пользователя
			try
			{
				$login = $_POST['login'];
				$pass = $_POST['passw'] = md5($_POST['passw']);
				$LogPass = new TestLogPass($login, $pass);
				if ($LogPass->Query()) {
					if ($_SESSION['cap_code'] == $_POST['captchacode']) {
						$_SESSION['sess_login'] = $_POST['login'];
						$_SESSION['sess_passw'] = $_POST['passw'];
						unset($LogPass);
						return TRUE;
					} else	{
						$this->msg = '<span style="color: red"><b>Введен неверный код</b></span><br>';
					}
				} else {
					$this->msg = '<span style="color: red"><b>Логин или пароль введены неправильно!</b></span><br>';
				}
			} catch(Exception $e)
			{
                $this->msg = $e->getMessage();
			}
		}
	}

	public function Reg()
	{
		if (isset($_POST['user_login']) and isset($_POST['user_password'])) {							 // Регистрация пользователя
			try
			{
				$login = $_POST['user_login'];
				$test_email = new TestEmail($login);
				if ($test_email->Test()) {
					$pass = md5($_POST['user_password']);
					$reg = new RegLk($login, $pass);
					$reg->ConnectDB(Constant::DBHOST, Constant::DBUSER, Constant::DBPASS);
					if ($name = $reg->Query()) {
						$this->msg = '<span style="color: red"><b>Регистрация пользователя ' . $name . ' выполнена, авторизуйтесь!</b></span><br>';
					}
				} else {
					$this->msg_reg = '<span style="color: red"><b>Введен некорректный E-Mail</b></span><br>';
				}
			} catch(Exception $e)
			{
				$this->msg_reg = $e->getMessage();
			}
		}
	}
}