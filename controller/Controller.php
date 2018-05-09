<?php

namespace controller;

use view\DefaultView;
use view\GoodsPage;
use view\UserLk;
use view\RegPage;
use view\UserPage;
use model\ViewGoods;
use model\Constant;
use model\LoadContent;
use model\Authorization;

/*spl_autoload_register(
	function ($class)
	{
		$class = str_replace("\\", "/", $class);
		$class = explode('/', $class);
		array_pop($class);
		$class = implode('/', $class);
		spl_autoload($class);
	});*/

//set_include_path($_SERVER['DOCUMENT_ROOT']);
spl_autoload_register();

class Controller
{
	protected $model;
	protected $view;
	public $content;
	protected $load_page;
	protected $view_goods;
	
	public function __construct($load_page)
	{
		$this->load_page = $load_page;
	}
	
	public function DefaultView()
	{
		$this->content = new LoadContent();
		$this->view = new DefaultView($this->content);
		$this->view->Display();
	}
	
	public function GoodsView()
	{
		$this->content = new LoadContent();
		$this->model = new ViewGoods($this->load_page);
		$this->model->ConnectDB(Constant::DBHOST, Constant::DBUSER, Constant::DBPASS);
		$this->view = new GoodsPage($this->content, $this->model);
		$this->view->Display();
	}
	
	public function UserLk()
	{
		$this->content = new LoadContent();
		$this->model = new Authorization();
		$this->view = new UserLk($this->content, $this->model);
		if ($this->model->Auth()) {
                $this->view = new UserPage($this->content);
                $this->view->Display();
			}
		$this->view->Display();
	}
	
	public function UserPage()
	{
		$this->content = new LoadContent();
		$this->view = new UserPage($this->content);
		$this->view->Display();
	}

    public function RegLk()
    {
        $this->content = new LoadContent();
        $this->model = new Authorization();
        $this->view = new RegPage($this->content, $this->model);
        $this->view->Display();
    }
}