<!-- Карточка товара -->

<?php if ( $latestProducts[0] ): ?>
    <?php foreach ( $latestProducts as $product ): ?>
        <div class="col-xs-8 col-sm-4 col-md-4 col-lg-4">
            <div class="thumbnail">
                <a href="/product/<?= $product->id; ?>" class="thumbnail" target="_blank">
                    <img style="width: auto; height: 150px" src="<?= $product->image1; ?>" alt="<?= $product->name; ?>" title="<?= $product->name; ?>">
                </a>

                <div class="caption">
                    <h3><?= $product->name; ?> <br> <?= $product->price; ?> ₽
                        <span id="<?= $product->id; ?>" class="label label-warning hidden" data-new="<?= $product->new; ?>">New</span>
                    </h3>
                    <span>Код товара: <?= $product->code; ?></span>
                    <p style="width: auto; height: 30px">
                        <?= $product->short_description; ?>
                    </p>
                    <p>
                        <a href="/product/<?= $product->id; ?>" class="btn btn-primary" role="button" target="_blank"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"> </span> Просмотр</a>
                        <a href="/cart/add/" class="btn btn-danger add-to-cart" role="button" data-id="<?= $product->code; ?>"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> </span> В корзину</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
