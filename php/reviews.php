<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Отзыв</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Имя *</label>
                        <input type="text" name="name-reviews" class="form-control" id="formGroupExampleInput" placeholder="Иван" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Приобретенный товар *</label>
                        <input type="text" name="product-reviews" class="form-control" id="formGroupExampleInput2" placeholder="Airpods Pro Premium" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Отзыв *</label>
                        <textarea name="text-reviews" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" name="btn-reviews" class="btn btn-dark">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="reviews" id = "reviews">
    <div class="container">
        <hr>
        <h1>ОТЗЫВЫ</h1>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter">Оставить отзыв</button>
        <p><?php if(isset($_POST['btn-reviews'])) add_reviews($server, $user, $pass, $dbname); ?></p>
        <div class="reviews-flex">
            <?php reviews_output($server, $dbname, $user, $pass); ?>
            <?php
            if(!isset($_GET['more'])) {
                ?>
            <form action = "#reviews" method = "get">
                <button type="submit" name = "more" value = "yes" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter">Смотреть больше</button>
            </form>
                <?php
            }
            ?>
        </div>
    </div>
</section>
