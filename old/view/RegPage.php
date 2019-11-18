<?php

namespace view;

use model\Authorization;
use model\LoadContent;

spl_autoload_register();

class RegPage extends ViewPage
{
    public $content;
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
                <?=$this->content->GetContent('./content/text1.txt')?>
                <br>
            </p>
        </article>
        <aside class="right_article">
            <p>
            <div align="right">
                <form id="reg" method="POST">
                    <fieldset>
                        <legend>Форма регистрации</legend>
                        <input class="pole" required type="email" name="user_login" size="50" placeholder="Введите E-Mail"><br>
                        <input class="pole" required type="password" name="user_password" size="50" placeholder="Введите пароль"><br>
                        <input class="key" type="submit" name="submit" value="Регистрация">
                        <input class="key" type="reset" value="Отмена"><br>
<?php
                    $this->model->Reg();
                    echo ($this->model->msg_reg);
?>
                    </fieldset>
                </form>
            </div>
            </p>
        </aside>
    </section>
    <div class="row">
<?php
    }
}
?>