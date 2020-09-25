<section>
    <div class="container">
        <div class="row">

            <button class="btn btn-primary" onclick="window.history.back()">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> </span> Назад
            </button>

            <h4>Просмотр заказа #<?= $userProcess->ordersDetails->customers_id; ?></h4>

            <h5>Информация о заказе:</h5>
            <table class="table-admin-small table-bordered table-striped table">
                <tr>
                    <td>Номер заказа</td>
                    <td><?= $userProcess->ordersDetails->customers_id; ?></td>
                </tr>
                <tr>
                    <td>Имя клиента</td>
                    <td><?= $userProcess->ordersDetails->name; ?></td>
                </tr>
                <tr>
                    <td>Телефон клиента</td>
                    <td><?= $userProcess->ordersDetails->phone; ?></td>
                </tr>
                <tr>
                    <td>Комментарий клиента</td>
                    <td><?= $userProcess->ordersDetails->comment; ?></td>
                </tr>
                <?php if ( $userProcess->ordersDetails->user_id != 0 ): ?>
                    <tr>
                        <td>ID клиента</td>
                        <td><?= $userProcess->ordersDetails->user_id; ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><b>Статус заказа</b></td>
                    <td><?= $userProcess->ordersDetails->status; ?></td>
                </tr>
                <tr>
                    <td><b>Дата заказа</b></td>
                    <td><?= $userProcess->ordersDetails->date; ?></td>
                </tr>
            </table>

            <h5>Товары в заказе</h5>

            <table class="table-admin-medium table-bordered table-striped table ">
                <tr>
                    <th>Код товара</th>
                    <th>Артикул товара</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество</th>
                </tr>
                <?php foreach ( $products as $product ): ?>
                    <tr>
                        <td><?= $product[ 'id' ]; ?></td>
                        <td><?= $product[ 'code' ]; ?></td>
                        <td><?= $product[ 'name' ]; ?></td>
                        <td>$<?= $product[ 'price' ]; ?></td>
                        <td><?= $productsQuantity[ $product[ 'id' ] ]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>

</section>
