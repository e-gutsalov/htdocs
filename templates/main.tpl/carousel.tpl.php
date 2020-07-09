<!--div class="container"-->

<?php if ( $carousel[0] ): ?>

    <div class="row">

        <div class="col-sm-12 col-md-12 col-lg-12 col-md-offset-0">

            <div class="thumbnail">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Показатели -->
                    <ol class="carousel-indicators">

                        <?php for ( $i = 0; $i < count( $carousel ); $i++ ): if ( $i == 0 ) { $active = 'active'; } else { $active = ''; } ?>

                        <li data-target="#carousel-example-generic" data-slide-to="<?= $i; ?>" class="<?= $active; ?>"> </li>

                        <?php endfor; ?>

                    </ol>

                    <!-- Обертка для слайдов -->

                    <div class="carousel-inner" role="listbox">

                        <?php foreach ( $carousel as $key => $item ): if ( $key == 0 ) { $active = 'active'; } else { $active = ''; } ?>

                            <div class="item <?= $active; ?>">
                                <img style="width: 1000px; height: 300px" src="<?= $item->image1; ?>" alt="Handicraft">
                                <div class="carousel-caption">
                                    <h3><?= $item->name; ?></h3>
                                    <p>Код товара <?= $item->code; ?></p>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>

                    <!-- Элементы управления -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"> </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>

        </div>

    </div>

<?php endif; ?>

<!--/div-->
