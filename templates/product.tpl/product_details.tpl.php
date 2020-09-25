<div class="container">

    <div class="row">

    <?php if ( !empty( (array) $productDetails ) ): ?>

        <div class="col-xs-6 col-md-6">
            <a class="thumbnail image" href="<?= $productDetails->image1; ?>" target="_blank">
                <img class="p-image" src="<?= $productDetails->image1; ?>" alt="<?= $productDetails->name; ?>" title="<?= $productDetails->name; ?>">
            </a>

            <?php foreach ( $images as $image ) : ?>

                <?php if ( !empty( $image ) ): ?>

                <div class="col-xs-4 col-md-4">
                    <a href="<?= $image; ?>" class="thumbnail">
                        <img class="s-image" src="<?= $image; ?>" alt="<?= $productDetails->name; ?>" title="<?= $productDetails->name; ?>">
                    </a>
                </div>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

        <div class="caption">
           <h3><?= $productDetails->name; ?> <br> <?= $productDetails->price; ?> ₽
               <span id="<?= $productDetails->code; ?>" class="label label-warning hidden" data-new="<?= $productDetails->new; ?>">New</span>
           </h3>
           <span>Код товара: <?= $productDetails->code; ?></span>
           <p>
                <?= $productDetails->description; ?>
           </p>
           <p>
               <a href="/cart/add/" class="btn btn-danger add-to-cart" role="button" data-id="<?= $productDetails->code; ?>"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> </span> В корзину</a>
               <a href="#" class="btn btn-danger" role="button" onClick="window.close()"><span class="glyphicon glyphicon-remove" aria-hidden="true"> </span> Закрыть окно</a>
           </p>
        </div>

    <?php else: ?>

        <div class="caption">
            <h3>
                <?= $catalogErr; ?>
            </h3>
            <p>
                <a href="#" class="btn btn-danger" role="button" onClick="window.close()"><span class="glyphicon glyphicon-remove" aria-hidden="true"> </span> Закрыть окно</a>
            </p>
        </div>

    <?php endif; ?>

    </div>

</div>
