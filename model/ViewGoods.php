<?php

// Загрузка каталога товара

namespace model;

class ViewGoods
{
	protected $load_page;
	protected $article;
	protected $action;
	protected $img;
	protected $sum;
	protected $text;
	protected $db;
	
	public function __construct($load_page)
	{
		$this->load_page = $load_page;
		$this->action = 'Index.php';
	}
	
	public function ConnectDB($host, $user, $pass)
	{
		@ $this->db = new \mysqli($host, $user, $pass); //Подключение к базе
		if (!$this->db->connect_errno) {
			$this->db->set_charset('utf8mb4');
			$this->db->select_db("base_betaphase");
		} else {
			throw new Exception('<span style="color: red"><b>В данный момент каталог с товарами недоступен. Повторите попытку позже!</b></span><br>');
	  		}
	}
	
	public function Query()
	{
		$query = "SELECT * FROM `goods` WHERE `category`='$this->load_page' ORDER BY `id_goods` ASC";
		if ($result = $this->db->query($query)) {
			while ($row = $result->fetch_object()) {
				$this->article = $row->id_goods;
				$this->img = $row->images_path;
				$this->sum = $row->sum;
				$this->text = $row->text;
				$this->Display();
			}
			$result->close();
		}
		$this->db->close();
	}
	
	public function Display()
	{
?>
	<div class="columns">
		<p class="thumbnail_align"> <img src="<?=$this->img?>" class="thumbnail"/> </p>
    	<h4><?=$this->sum?>&#x20bd
    		<form action="<?=$this->action?>" method="GET" enctype="application/x-www-form-urlencoded">
    		<input type="hidden" name="article" id="article" value="<?=$this->article?>">
    		<input type="hidden" name="load_page" id="load_page" value="user_lk">
    		<input type="submit" class="key" name="submit" id="submit" value="Заказать">
    		</form>
		</h4>
    	<p>Артикул: <?=$this->article?>. <?=$this->text?></p>
	</div>
<?php
	}
}
?>