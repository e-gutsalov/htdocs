
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/product">Управление товарами</a></li>
                    <li class="active">Удалить товар</li>
                </ol>
            </div>

            <button class="btn btn-primary" onclick="window.history.back()">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> </span> Назад
            </button>

            <h4>Удалить товар #<?= $code; ?></h4>


            <p>Вы действительно хотите удалить этот товар?</p>

            <form method="POST">
                <input class="btn btn-danger" role="button" type="submit" name="submit" value="Удалить" />
            </form>

        </div>
    </div>
</section>
