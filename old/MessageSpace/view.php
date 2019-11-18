<?php

spl_autoload_register();

class view
{
    private
        $model;

    public function __construct(model $model)
    {
        $this->model = $model;
    }

    public function Head()
    {
?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
            <link type="text/css" href="css/bootstrap.css" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
            <script type="text/javascript" src="js/bootstrap.js"></script>
            <script type="text/javascript" src="js/vue.js"></script>
            <title>Сообщения из космоса</title>
        </head>
<?php
    }

    public function Body()
    {
?>
        <body>
        <div>
            <table class="table">
                <tr>
                    <th>Время</th>
                    <th>Сообщение</th>
                    <th>Пометить как прочитанное</th>
                    <th>Пометить как не прочитанное</th>
                </tr>

<?php
        $this->model->getRead();
        $this->model->unRead();
        $this->model->getFile();
?>
        </table>
        </div>
<?php
    }

    public function Footer()
    {
?>
        <footer>
        <div>

        </div>
        </footer>

        </body>
        </html>
<?php
    }

    public function Display()
    {
        $this->Head();
        $this->Body();
        $this->Footer();
    }
}
?>