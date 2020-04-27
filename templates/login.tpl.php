<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ( isset( $userProcess->errors ) and is_array( $userProcess->errors ) ): ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ( $userProcess->errors as $error ): ?>
                        <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="signup-form"><!--sign up form-->
                    <h2>Вход на сайт</h2>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="InputEmail">Введите имя</label>
                            <input class="form-control" type="email" name="InputEmail" id="InputEmail" placeholder="E-mail" value="<?= $userProcess->email; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="InputPassword">Введите имя</label>
                            <input class="form-control" type="password" name="InputPassword" id="InputPassword" placeholder="Пароль" value="<?= $userProcess->password; ?>"/>
                        </div>
                        <input type="submit" name="submit" class="btn btn-default" value="Вход" />
                    </form>
                </div><!--/sign up form-->

                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>
