
<div class="container">

    <div class="row">

        <!--div class="media">
            <div class="media-left media-middle">
                <a href="#">
                    <img class="media-object" style="width: 128px; height: 128px" src="/content/1/test1.jpg" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Middle aligned media</h4>
                Польное описание товара.
            </div>
        </div-->

        <button class="btn btn-primary" onclick="window.history.back()">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> </span> Назад
        </button>
        <a class="btn btn-primary checkout" href="/catalog" role="button"><i class="fa fa-shopping-cart"> </i> Вернуться к покупкам</a>

    <?php if ( !empty( $sess['cart']['productsInCart'] ) ): ?>

        <a class="btn btn-danger checkout" href="/cart/checkout"><i class="fa fa-shopping-cart"> </i> Оформить заказ</a>

        <h3>Вы выбрали такие товары:</h3>

        <table class="table table-hover table-bordered">

            <tr>
                <th>Код товара</th>
                <th>Название</th>
                <th>Стомость, ₽</th>
                <th>Количество, шт</th>
                <th>Удалить</th>
            </tr>

            <?php foreach ( $sess['cart']['productsInCart'] as $product ): ?>

            <tr class="cart-del">
                <td><?= $product->code ?></td>
                <td>
                    <a href="/product/<?= $product->code ?>" target="_blank">
                        <?= $product->name ?>
                    </a>
                </td>
                <td><?= $product->price ?></td>
                <td><?= $sess['cart']['productsCode'][$product->code] ?></td>
                <td>
                    <a class="del-to-cart" href="/cart/delete/" data-id="<?= $product->code ?>">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>
                    </a>
                </td>
            </tr>

            <?php endforeach; ?>

            <tr>
                <td colspan="4">Общая стоимость, ₽:</td>
                <td id="totalPrice"><?= $sess['cart']['totalPrice'] ?></td>
            </tr>

        </table>

        <?php else: ?>
            <h3>Корзина пуста</h3>

    <?php endif; ?>

    </div>

</div>
