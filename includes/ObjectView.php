<?php
// object_view
class ViewGoods {
	protected $load_page;
	protected $article;
	protected $action;
	protected $img;
	protected $sum;
	protected $text;
	protected $db;
	public function __construct($load_page) {
		$this->load_page = $load_page;
		$this->action = 'index.php';
	}
	public function ConnectDB() {
		$this->db = @ new mysqli("localhost", "root", "metallica");
		if (!$this->db->connect_errno) {
			$this->db->query('SET NAMES UTF8mb4');
			$this->db->select_db("base_betaphase");
		} else {
			echo('Не удалось установить подключение к базе данных!' . $this->db->connect_error);
	  		}
	}
	public function Query() {
		$query = "SELECT * FROM `goods` WHERE `category`='$this->load_page' ORDER BY `id_goods` ASC";
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
	public function Displey() {
	echo('<div class="columns">
	 		<p class="thumbnail_align"> <img src="' . $this->img . '" class="thumbnail"/> </p>
      			<h4>' . $this->sum . '&#x20bd
      			<form action="' . $this->action . '" method="GET" enctype="application/x-www-form-urlencoded">
      			<input type="hidden" name="article" id="article" value="' . $this->article . '">
      			<input type="hidden" name="load_page" id="load_page" value="user_lk">
      			<input type="submit" class="key" name="submit" id="submit" value="Заказать">
      			</form>
				</h4>
     		<p>Артикул: ' . $this->article . '. ' . $this->text . '</p>
		</div>');
	}
}
class UserGoods extends ViewGoods {
	public function __construct($article) {
		$this->article = $article;
		$this->action = 'zakaz.php';
	}
	public function Query() {
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
}
?>