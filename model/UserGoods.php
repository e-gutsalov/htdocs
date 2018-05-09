<?php

// Загрузка товара в корзину

namespace model;

//use  model\ViewGoods;

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

class UserGoods extends ViewGoods
{
	public function __construct($article)
	{
		$this->article = $article;
		$this->action = '../view/Zakaz.php';
	}
	public function Query()
	{
		$query = "SELECT * FROM `goods` WHERE `id_goods`=$this->article";
		if ($result = $this->db->query($query)) {
			while ($pole = $result->fetch_object()) {
				$this->article = $pole->id_goods;
				$this->img = $pole->images_path;
				$this->sum = $pole->sum;
				$this->text = $pole->text;
				$this->Displey();
			}
			$result->close();
		}
		$this->db->close();
	}
	public function Displey()
	{
?>
	<div class="columns">
		<p class="thumbnail_align"><img src="<?=$this->img?>" class="thumbnail"/></p>
     	<h4><?=$this->sum?>&#x20bd
     		<form action="<?=$this->action?>" method="GET" enctype="application/x-www-form-urlencoded">
     		<input type="hidden" name="article" id="article" value="<?=$this->article?>">
     		<input type="hidden" name="load_page" id="load_page" value="user_lk">
     		</form>
		</h4>
    	<p>Артикул: <?=$this->article?>. <?=$this->text?></p>
	</div>
<?php
	}
}
?>