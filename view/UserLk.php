<?php

namespace view;

use model\Authorization;
use model\LoadContent;

spl_autoload_register();

class UserLk extends ViewPage
{
	private $content;
	protected $model;
	
	public function __construct(LoadContent $content, Authorization $model)
	{
		$this->content = $content;
		$this->model = $model;
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
	<div align="right" style="margin: 0 10% 0 40%">
		<form id="login" method="POST"></form>
		    <fieldset>
			    <legend>Вход в учетную запись</legend>
			    <input class="pole" required form="login" type="email" name="login" placeholder="Введите E-Mail"><br>
			    <input class="pole" required form="login" type="password" name="passw" placeholder="Введите пароль"><br>
			    <img src="../model/Captcha.php"/>
			    <input class="pole" required form="login" type="text" name="captchacode" placeholder="Введите код с картинки"><br>
				    <form id="reg" action="../index.php" method="GET"></form>
				    <input form="reg" class="key" type="submit" value="Регистрация">
				    <input form="reg" type="hidden" name="load_page" value="reg_lk">
			    <input form="login" class="key" type="submit" value="Войти"><br>
<?php
		    $this->model->Auth();
		    echo $this->model->msg;
?>
		    </fieldset>
	</div>
	   </p>
	   </aside>
	</section>
	<div class="row">
<?php
	}
}
?>