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
        <a class="btn btn-primary checkout" href="/catalog" role="button"><i class="fa fa-shopping-cart"> </i> Вернуться
            к покупкам</a>

        <h3>История ваших заказов:</h3>

        <table class="table table-hover table-bordered">

            <tr>
                <th>Номер заказа</th>
                <th>Детализация заказа</th>
                <th>Дата покупки</th>
                <th>Статус заказа</th>
            </tr>

            <?php foreach ( $userProcess->ordersList as $order ): ?>

                <tr class="cart-del">
                    <td><?= $order->customers_id ?></td>
                    <td>
                        <a href="/user/history/details/<?= $order->customers_id ?>">Просмотр заказа</a>
                    </td>
                    <td><?= $order->date ?></td>
                    <td><?= $order->status ?></td>
                </tr>

            <?php endforeach; ?>

        </table>

    </div>

</div>
