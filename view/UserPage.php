<?php

namespace view;

//use view\ViewPage;
use model\UserGoods;
use model\Constant;

/*spl_autoload_register(
    function ($class)
    {
        $class = str_replace("\\", "/", $class);
        $class = explode('/', $class);
        array_pop($class);
        $class = implode('/', $class);
        spl_autoload($class);
    });*/

spl_autoload_register();

class UserPage extends ViewPage
{
	public $content;
	protected $model;
	
	public function __construct($content)
	{
		$this->content = $content;
		//$this->model = $model;
	}
	
	public function Body()
	{
?>
	<section>
    	<h2 class="noDisplay">Main Content</h2>
    	<article class="left_article">
      		<h3>Добро пожаловать!</h3>   	
      		<p>
     		<?=$this->content->GetContent('./content/text1.txt')?>
      		<br>
      		<?=$this->content->GetContent('./content/text2.txt')?>
      		<br>
     		</p>
    	</article>
    	<aside class="right_article">
    	<p>
<?php
		echo('<pre>');
	 	print_r($_SESSION);
		echo('</pre>');

?>
		</p>
		</aside>
	</section>
	<div class="row">
<?php
	 if (isset($_GET['article'])) {
?>
		 <div align="right" style="margin: 0 10% 0 50%">
		 <form action="../model/exit_page.php">
		 <input class="key" type="submit" value="Удалить товар">
		 </form>
		 Добро пожаловать, Гость!
		 </div>
<?php
		 $_SESSION['article'][] = $_GET['article'];
		 $art_session = $_SESSION['article'];
		 foreach ($art_session as $key=>$article) {
			 $obj = new UserGoods($article);
			 $obj->ConnectDB(Constant::DBHOST, Constant::DBUSER, Constant::DBPASS);
			 $obj->Query();
			 unset($obj);
		 }
	 } elseif (empty($_SESSION['article']) and isset($_SESSION['sess_login'])) {
?>
		 <div align="right" style="margin: 0 10% 0 50%">
		 <form action="../model/exit_page.php">
		 <input class="key" type="submit" value="Выход">
		 </form>
		 Добро пожаловать, <?=$_SESSION['sess_login']?>!
		 </div>
<?php
	 } elseif (isset($_SESSION['article']) and empty($_SESSION['sess_login'])) {
?>
		 <div align="right" style="margin: 0 10% 0 50%">
		 <form action="../model/exit_page.php">
		 <input class="key" type="submit" value="Удалить товар">
		 </form>
		 Добро пожаловать, Гость!
		 </div>
<?php
		 $art_session = $_SESSION['article'];
		 foreach ($art_session as $key=>$article) {
			 $obj = new UserGoods($article);
			 $obj->ConnectDB(Constant::DBHOST, Constant::DBUSER, Constant::DBPASS);
			 $obj->Query();
			 unset($obj);
		 }
	 } elseif (isset($_SESSION['article']) and isset($_SESSION['sess_login'])) {
?>
		 <div align="right" style="margin: 0 10% 0 50%">
		 <form action="../model/exit_page.php">
		 <input class="key" type="submit" value="Выход">
		 </form>
		 Добро пожаловать, <?=$_SESSION['sess_login']?>!
		 </div>
<?php
		 $art_session = $_SESSION['article'];
		 foreach ($art_session as $key=>$article) {
			 $obj = new UserGoods($article);
			 $obj->ConnectDB(Constant::DBHOST, Constant::DBUSER, Constant::DBPASS);
			 $obj->Query();
			 unset($obj);
		 }
	 }
	}
}
?>