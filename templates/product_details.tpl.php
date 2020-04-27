<div class="container">

    <div class="row">

    <?php if ( $productDetails[0] ): ?>
        <?php foreach ( $productDetails as $product ): ?>

        <div class="col-xs-6 col-md-6">
            <a href="<?= $product->image1; ?>" class="thumbnail">
                <img src="<?= $product->image1; ?>" alt="<?= $product->name; ?>" title="<?= $product->name; ?>">
            </a>

            <div class="col-xs-4 col-md-4">
                <a href="<?= $product->image1; ?>" class="thumbnail">
                    <img src="<?= $product->image1; ?>" alt="<?= $product->name; ?>" title="<?= $product->name; ?>">
                </a>
            </div>

            <div class="col-xs-4 col-md-4">
                <a href="<?= $product->image2; ?>" class="thumbnail">
                    <img src="<?= $product->image2; ?>" alt="<?= $product->name; ?>" title="<?= $product->name; ?>">
                </a>
            </div>

            <div class="col-xs-4 col-md-4">
                <a href="<?= $product->image3; ?>" class="thumbnail">
                    <img src="<?= $product->image3; ?>" alt="<?= $product->name; ?>" title="<?= $product->name; ?>">
                </a>
            </div>

        </div>

        <div class="caption">
           <h3><?= $product->name; ?> <br> <?= $product->price; ?> ₽
               <span id="$product->code" class="label label-warning hidden" data-new="<?= $product->new; ?>">New</span>
           </h3>
           <span>Код товара: <?= $product->code; ?></span>
           <p>
                <?= $product->description; ?>
           </p>
           <p>
               <a href="/cart/add/" class="btn btn-danger add-to-cart" role="button" data-id="<?= $product->code; ?>"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> </span> В корзину</a>
           </p>
        </div>

        <?php endforeach; ?>
    <?php endif; ?>

    </div>

</div>
