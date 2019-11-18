<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Description" lang="ru" content="Аксессуары, Чехлы, Бамперы, Защитные стекла, кабели, iPhone, Samsung">
<meta name="Keywords" lang="ru" content="Аксессуары, Чехлы, Бамперы, Защитные стекла, кабели, iPhone, Samsung">
<meta name="Robots" content="index, follow">
<title>BETAPHASE</title>
<link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="favicon.ico" type="image/ico">
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body>
<div class="container">
<header>
    <div class="primary_header">
      <a href="index.php"><h1 class="title">BETAPHASE</h1></a>
    </div>
    <nav class="secondary_header" id="menu">
      <ul>
        <a href="company.php">				<li>О Компании</li></a>
		<a href="iPhone5_5S_SE.php">		<li>iPhone5/5S/SE</li></a>
		<a href="iPhone6_6S_7_8.php">		<li>iPhone6/6S/7/8</li></a>
		<a href="iPhone6+_6S+_7+_8+.php">	<li>iPhone6+/6S+/7+/8+</li></a>
		<a href="iPhoneX.php">				<li>iPhoneX</li></a>
		<a href="applewatch.php">			<li>Apple Watch</li></a>
		<a href="samsung.php">				<li>Samsung</li></a>
		<a href="cabel.php">				<li>Кабели</li></a>
		<a href="accessories.php">			<li>Аксессуары</li></a>
		<a href="contact.php">				<li>Контакты</li></a>
      </ul>
    </nav>
  </header>
<section>
    <h2 class="noDisplay">Main Content</h2>
    <article class="left_article">
      <h3>Заказать товар просто и легко!</h3>
       
       <p>
        <?php
			require_once("includes/inc.php");
		   
		   	echo (f_text ('./content/text1.txt')), "<br>",
		   		 (f_text ('./content/text2.txt')), "<br>";
		?>
       </p>
                     
    </article>
    <aside class="right_article">
    	
    	<p>
    	  		  		
  		<form action="kupit.php" method="GET" enctype="application/x-www-form-urlencoded">
  		<input type="text" class="pole" name="article" id="article" value="<?php echo($_GET['article']) ?>" size="30"> <br>
  		<input type="tel" class="pole" name="tel" id="tel" placeholder="Введите номер телефона" size="30"> <br>
      	<input type="email" class="pole" name="email" id="email" placeholder="Введите e-mail" size="30"> <br>
      	<textarea name="komment" class="pole" id="komment" placeholder="Добавте комментарий к заказу" cols="50" rows="10"></textarea> <br>
      	<div class="g-recaptcha" data-sitekey="6Ld51D0UAAAAAIWHv4oO3OjCjZ5qOKUL-zMm_heG"></div>
      	<input type="submit" class="key" name="submit" id="submit" value="Купить">
      	<input type="reset" class="key" name="reset" id="reset" value="Не покупать">
      	</form>
      	
      	</p>
   	
    	<!--<img src="images/f20121019082715-kolag1.jpg" alt="" width="400" height="200" class="placeholder"/>-->
    </aside>
  </section>
  <div class="row blockDisplay">
    <div class="column_half left_half">
      <a href="tel:+7(921)861-45-57"><h2 class="column_title"><img src="images/phone.png" width="100" alt="+7(921)861-45-57"/></h2></a>
    </div>
    <div class="column_half right_half">
      <a href="mailto:Teo1319@gmail.com"><h2 class="column_title"><img src="images/mail.png" width="100" alt="Teo1319@gmail.com"/></h2></a>
    </div>
  </div>
  <div class="social">
    <p class="social_icon"><a href="https://vk.com/id141885855" target="_blank">
    	<img src="images/SocSety/vk.jpg" width="100" alt="В Контакте" class="thumbnail_0"/></a></p>
    <p class="social_icon"><img src="images/SocSety/Facebook.png" width="100" alt="" class="thumbnail_0"/></p>
    <p class="social_icon"><img src="images/SocSety/insta.jpeg" width="100" alt="" class="thumbnail_0"/></p>    
  </div>
  <footer class="secondary_header footer">
    <div class="copyright">&copy;2017 - <strong>BETAPHASE</strong></div>
  </footer>
</div>
</body>
</html>