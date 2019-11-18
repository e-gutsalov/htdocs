<?php

namespace view;

use model\LoadContent;

spl_autoload_register();

class DefaultView extends ViewPage
{
	public $content;
	protected $model;
	
	public function __construct(LoadContent $content)
	{
		$this->content = $content;
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
    		<img src="../images/f20121019082715-kolag1.jpg" alt="" width="200" height="100" class="placeholder"/>
    	</aside>
	</section>
	<div class="row">
<?php
	}
}
?>