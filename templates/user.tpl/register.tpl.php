<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ( $userProcess->result ): ?>
                <div class="alert alert-success text-center" role="alert">
                    <h3>Вы зарегистрированы!</h3>
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

                <h2>Регистрация на сайте</h2>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="InputName">Введите имя</label>
                            <input class="form-control" type="text" name="InputName" id="InputName" placeholder="Имя" value="<?= $userProcess->name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="InputEmail">Введите E-mail</label>
                            <input class="form-control" type="email" name="InputEmail" id="InputEmail" placeholder="E-mail" value="<?= $userProcess->email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="InputPassword">Введите пароль</label>
                            <input class="form-control" type="password" name="InputPassword" id="InputPassword" placeholder="Пароль" value="<?= $userProcess->password; ?>">
                        </div>
                        <label for="InputSubmit"> </label>
                        <input class="btn btn-default" type="submit" name="submit" id="InputSubmit" value="Регистрация">
                    </form>

                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>
