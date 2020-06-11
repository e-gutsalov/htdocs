
<section>
    <div class="container">
        <div class="row">

            <div class="col-md-6">

                <div class="signup-form"><!--sign up form-->
                    <h2>Вы вошли в профиль, <?= $sess['user']->name ?></h2>

                    <ul>
                        <li><a href="/user/edit">Редактировать данные</a></li>
                        <li><a href="/user/history">Список покупок</a></li>
                        <?= ( $sess['user']->role == 'admin' ) ? '<li><a href="/admin">Админпанель</a></li>' : ''; ?>
                    </ul>

                </div><!--/sign up form-->

                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>
