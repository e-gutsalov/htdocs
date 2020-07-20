<div class="container">

    <div class="row">

        <div class="col-sm-6 col-md-3">
            <div class="list-group">
                <?php if ( $categoriesList[0] ): ?>
                    <?php foreach ( $categoriesList as $categories ): ?>
                        <button class="list-group-item <?= ( $category == $categories->category ) ? 'list-group-item-success' : ''; ?>" type="button" href="/category/<?= $categories->category; ?>">
                            <?= $categories->name; ?>
                            <span class="badge"><?= empty( $count[$categories->category] )  ? '0' : $count[$categories->category]->count; ?></span>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-sm-6 col-md-9">
