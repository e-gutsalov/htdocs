<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">

                <button class="btn btn-primary" onclick="window.history.back()">
                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> </span> Назад
                </button>

                <div class="features_items">
                    <h2 class="title text-center">Оформление заказа</h2>


                    <?php if ( $cartProcess->result ): ?>
                        <p>Заказ оформлен. Мы Вам перезвоним.</p>
                    <?php else: ?>

                        <p>Выбрано товаров: <?= $sess[ 'cart' ][ 'count' ]; ?> , на
                            сумму: <?= $sess[ 'cart' ][ 'totalPrice' ] ?> ₽</p><br/>

                        <?php if ( !$cartProcess->result ): ?>

                            <div class="col-sm-9">
                                <?php if ( isset( $cartProcess->errors ) && is_array( $cartProcess->errors ) ): ?>
                                    <ul>
                                        <?php foreach ( $cartProcess->errors as $error ): ?>
                                            <li> - <?= $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>

                                <div class="login-form">
                                    <form action="#" method="post">

                                        <div class="form-group">
                                            <label for="userName">Ваше имя</label>
                                            <input class="form-control" id="userName" type="text" name="InputName"
                                                   placeholder="Ваше имя"
                                                   value="<?= empty( $sess[ 'user' ] ) ? '' : $sess[ 'user' ]->name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="userName">Электронная почта</label>
                                            <input class="form-control" id="userEmail" type="text" name="userEmail"
                                                   placeholder="Электронная почта"
                                                   value="<?= empty( $sess[ 'user' ] ) ? '' : $sess[ 'user' ]->email; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="userPhone">Номер телефона</label>
                                            <input class="form-control" id="userPhone" type="text" name="InputPhone"
                                                   placeholder="Номер телефона"
                                                   value="<?= empty( $sess[ 'user' ] ) ? '' : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="userAddress">Адрес доставки</label>
                                            <input class="form-control" id="userAddress" type="text" name="InputAddress"
                                                   placeholder="Адрес доставки"
                                                   value="<?= empty( $sess[ 'user' ] ) ? '' : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="userComment">Комментарий к заказу</label>
                                            <textarea class="form-control" id="userComment" type="text"
                                                      name="InputComment"
                                                      placeholder="Комментарий к заказу"><?= empty( $sess[ 'user' ] ) ? '' : ''; ?></textarea>
                                        </div>
                                        <input class="btn btn-danger" type="submit" name="submit" value="Оформить">

                                    </form>
                                </div>

                            </div>

                        <?php endif; ?>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</section>
