<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-6 col-sm-offset-3 padding-right">

                <?php if ( $userProcess->result ): ?>
                <div class="alert alert-success text-center" role="alert">
                    <h3>Учетные данные изменены!</h3>
                </div>
                <?php else: ?>
                <?php if ( isset( $userProcess->errors ) and is_array( $userProcess->errors ) ): ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ( $userProcess->errors as $error ): ?>
                        <li> - <?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <button class="btn btn-primary" onclick="window.history.back()">
                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> </span> Назад
                </button>

                <h2>Редактирование данных пользователя</h2>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="InputName">Введите новое имя</label>
                        <input class="form-control" type="text" name="InputName" id="InputName" placeholder="Имя" value="<?= $sess['user']->name; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Введите новый E-mail</label>
                        <input class="form-control" type="email" name="InputEmail" id="InputEmail" placeholder="E-mail" value="<?= $sess['user']->email; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Введите новый пароль</label>
                        <input class="form-control" type="password" name="InputPassword" id="InputPassword" placeholder="Пароль" value="<?= $sess['user']->password; ?>"/>
                    </div>
                    <input class="btn btn-primary" type="submit" name="submit" id="InputSubmit" value="Изменить" />
                </form>

                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>