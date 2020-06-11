<div class="container">

    <div class="row">

        <div class="col-sm-6 col-md-3">
            <div class="list-group">
                <?php if ( $categoriesList[0] ): ?>
                    <?php foreach ( $categoriesList as $value ): ?>
                        <button class="list-group-item <?= ( $category == $value->category ) ? 'list-group-item-success' : ''; ?>" type="button" href="/category/<?= $value->category; ?>">
                            <?= $value->name; ?>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-sm-6 col-md-9">
