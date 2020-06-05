<!-- Меню навигации -->

<header>

    <div class="container-fluid">

        <div class="page-header">

            <div class="row">

                <div class="col-md-1">
                    <a class="navbar-brand" href="/">
                        <img style="width: 60px; height: 60px" alt="Handicrafts" src="/icons/prize.png">
                    </a>
                </div>
                <div class="col-md-9">
                    <h1>HANDI <small>Магазин изделий ручной работы</small></h1>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-social-icon btn-lg btn-vk" role="button" href="#" onclick="window.open('https://vk.com/myhandicraftspb');"> <span class="fa fa-vk"> </span> </button>
                    <button type="button" class="btn btn-social-icon btn-lg btn-instagram" role="button" href="#" onclick="window.open('https://www.instagram.com/myhandicraftru');"> <span class="fa fa-instagram"> </span> </button>
                    <button type="button" class="btn btn-social-icon btn-lg btn-facebook" role="button" href="#" onclick="window.open('https://www.facebook.com/myhandicraftru/shop');"> <span class="fa fa-facebook"> </span> </button>
                </div>

            </div>

        </div>

    </div>

    <nav class="navbar navbar-default" data-spy="affix" data-offset-top="30" data-offset-bottom="200" role="navigation">

        <div class="container-fluid">

            <!--div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>
                </button>
                <a class="navbar-brand" href="/">
                    <img style="width: 28px; height: 28px" alt="Handicrafts" src="/icons/prize.png">
                </a>
            </div-->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">
                    <li class="<?= isset( $main ) ? 'active' : ''; ?>"><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"> </span> Главная</a></li>
                    <li class="<?= isset( $catalog ) ? 'active' : ''; ?>"><a href="/catalog"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> </span> Каталог</a></li>
                    <li class="{news}"><a href="/news"><span class="glyphicon glyphicon-bell" aria-hidden="true"> </span> Новости</a></li>
                    <li class="<?= isset( $callback ) ? 'active' : ''; ?>"><a href="/callback"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span> Обратная связь</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="<?= isset( $cart ) ? 'active' : ''; ?>">
                        <a href="/cart">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> </span> Корзина
                            <span class="badge" id="cart-count"><?= isset( $sess['cart']['count'] ) ? $sess['cart']['count'] : '0'; ?></span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?= empty( $sess['user'] ) ? '<span class="glyphicon glyphicon-lock" aria-hidden="true"> </span> Войти/Регистрация' : '<span class="glyphicon glyphicon-user" aria-hidden="true"> </span> Профиль'; ?>
                            <span class="caret"> </span>
                        </a>
                        <ul class="dropdown-menu">
                            <?= empty( $sess['user'] ) ? '<li><a href="/user/login">Вход</a></li>' : ''; ?>
                            <?= empty( $sess['user'] ) ? '<li><a href="/user/register">Регистрация</a></li>' : ''; ?>
                            <?= empty( $sess['user'] ) ? '' : '<li><a href="/user">Профиль</a></li>'; ?>
                            <?= empty( $sess['user'] ) ? '' : '<li role="separator" class="divider"> </li>'; ?>
                            <?= empty( $sess['user'] ) ? '' : '<li><a href="/user/logout">Выход</a></li>'; ?>
                        </ul>
                    </li>
                    <li><p class="navbar-text">Заказ товара <a href="tel: +79219999999">+7-999-999-99-99</a></p></li>
                </ul>

            </div>

        </div>

    </nav>

</header>
