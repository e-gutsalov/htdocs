<?php

session_start();

mb_internal_encoding("UTF-8");

spl_autoload_register(function ($class) {include $class . '.php';});

$load_page = isset($_GET['load_page']) ? $_GET['load_page'] : FALSE;	// Загрузка каталога

$controller = new Controller($load_page);

	switch ($load_page)
	{
		case 'iPhone5_5S_SE':
			$controller->GoodsView();
		break;
			
		case 'iPhone6_6S_7_8':
			$controller->GoodsView();
		break;
			
		case 'iPhone6p_6Sp_7p_8p':
			$controller->GoodsView();
		break;
			
		case 'user_lk':
			if (isset($_GET['article']))
			{
				$controller->UserPage();
			} elseif (isset($_SESSION['article']) or isset($_SESSION['sess_passw']))
			{
				$controller->UserPage();
			} else
			{
				$controller->UserLk();
			}
		break;
			
		case 'reg_lk':

		break;
			
		default:
			$controller->DefaultView();
	}
?>