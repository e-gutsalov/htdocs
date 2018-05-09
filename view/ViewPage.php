<?php

namespace view;

class ViewPage
{
	public $content;
	
	public function __construct()
	{

	}
	
	public function Display()
	{
		echo($this->Header());
		echo($this->Nav());
		echo($this->Body());
		echo($this->Footer());
	}
	
	public function Header()
	{ 
?>
		<!doctype html>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="Description" lang="ru" content="Аксессуары, Чехлы, Бамперы, Защитные стекла, кабели, iPhone, Samsung">
		<meta name="Keywords" lang="ru" content="Аксессуары, Чехлы, Бамперы, Защитные стекла, кабели, iPhone, Samsung">
		<meta name="Robots" content="index, follow">
		<link href="../css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
		<link rel="shortcut icon" href="../images/favicon.ico" type="image/ico">
        <title>BETAPHASE</title>
		</head>
<?php
	}
	
	public function Nav()
	{
?>
    <body>
	<div class="container">
  		<header>
   			<div class="primary_header">
      			<a href="../index.php"><h1 class="title">BETAPHASE</h1></a>
    		</div>
   			<nav class="secondary_header" id="menu">
   		  	<ul>
   		    	<a href="?load_page=company">				<li>О Компании</li></a>
				<a href="?load_page=iPhone5_5S_SE">			<li>iPhone5/5S/SE</li></a>
				<a href="?load_page=iPhone6_6S_7_8">		<li>iPhone6/6S/7/8</li></a>
				<a href="?load_page=iPhone6p_6Sp_7p_8p">	<li>iPhone6+/6S+/7+/8+</li></a>
				<a href="?load_page=iPhoneX">				<li>iPhoneX</li></a>
				<a href="?load_page=applewatch">			<li>Apple Watch</li></a>
				<a href="?load_page=samsung">				<li>Samsung</li></a>
				<a href="?load_page=cabel">					<li>Кабели</li></a>
				<a href="?load_page=accessories">			<li>Аксессуары</li></a>
				<a href="?load_page=contact">				<li>Контакты</li></a>
				<a href="?load_page=user_lk">				<li>Личный кабинет</li></a>
   		   	</ul>
   			</nav>
  		</header>
<?php
	}
	
	public function Body()
	{
?>
	<section>
    	<h2 class="noDisplay">Main Content</h2>
    	<article class="left_article">
      		<h3>Добро пожаловать!</h3>   	
      		<p>

      		<br>

      		<br>
     		 </p>
    	</article>
    	<aside class="right_article">
    		<img src="../images/f20121019082715-kolag1.jpg" alt="" width="200" height="100" class="placeholder"/>
    	</aside>
	</section>
	<div class="row">
<?php
	}
	
	public function Footer()
	{
?>
	</div>
	   <div class="row blockDisplay">
	    <div class="column_half left_half">
	      <a href="tel:+7(921)861-45-57"><h2 class="column_title"><img src="../images/phone.png" width="100" height="100" alt="+7(921)861-45-57"/></h2></a>
	    </div>
	    <div class="column_half right_half">
	      <a href="mailto:Teo1319@gmail.com"><h2 class="column_title"><img src="../images/mail.png" width="100" height="100" alt="Teo1319@gmail.com"/></h2></a>
	    </div>
	  </div>
	  <div class="social">
	    <p class="social_icon"><a href="https://vk.com/id141885855" target="_blank">
	    	<img src="../images/SocSety/vk.jpg" width="100" alt="В Контакте" class="thumbnail_0"/></a></p>
	    <p class="social_icon"><img src="../images/SocSety/Facebook.png" width="100" alt="" class="thumbnail_0"/></p>
	    <p class="social_icon"><img src="../images/SocSety/insta.jpeg" width="100" alt="" class="thumbnail_0"/></p>
	  </div>
	  <footer class="secondary_header footer">
	    <div class="copyright">&copy;2018 - <strong>BETAPHASE</strong></div><div align="center"><img src="../model/att_count.php"/></div>
	  </footer>
	</div>
	</body>
	</html>
<?php
	}
}
?>