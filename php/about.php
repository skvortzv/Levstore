<div class="modal fade" id="orderModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Напишите Ваш телефон.<br>И мы вам перезвоним!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Имя *</label>
                        <input type="text" name="order-name" class="form-control" id="formGroupExampleInput" placeholder="Иван" required>
                    </div>
                      <div class="form-group">
                          <label for="formGroupExampleInput2">Телефон *</label>
                          <input class = "tel" name = "order-number" class="form-control" id="formGroupExampleInput2" placeholder="+7" required>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" name="btn-order" class="btn btn-success">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="about-company" id="about">
    <div class="container">
        <div class="ab-description">
            <h1><?php print($_about_h); ?></h1>
            <p><?php print($_about_description); ?></p>
        </div>
        <div class="ab-img-1">
            <img src="<?php print($_about_logo_path_1); ?>" class="parallax__layer" data-speed="0.01">
        </div>
        <div class="ab-advantage">
            <div class="advantage-1">
                <img src="<?php print($_about_advantage_img_1); ?>">
                <p><?php print($_about_advantage_text_1); ?></p>
            </div>
            <div class="advantage-2">
                <img src="<?php print($_about_advantage_img_2); ?>">
                <p><?php print($_about_advantage_text_2); ?></p>
            </div>
            <div class="advantage-3">
                <img src="<?php print($_about_advantage_img_3); ?>">
                <p><?php print($_about_advantage_text_3); ?></p>
            </div>
        </div>
        <div class="ab-buttons">
            <button type="button" onclick="myFunction()" class="btn btn-outline-success" data-toggle="modal" data-target="#orderModalCenter">Заказать</button>
            <p><?php if(isset($_POST['btn-order'])) send(-1, htmlspecialchars($_POST['order-name']), htmlspecialchars($_POST['order-number']), $work_mail, $server, $dbname, $user, $pass);  ?></p>
            <button type="button" class="btn btn-outline-light" onclick="document.location = '#catalog'">Перейти в каталог</button>
        </div>
        <div class="ab-img-2">
            <img src="<?php print($_about_logo_path_2); ?>" class="parallax__layer" data-speed="0.005">
        </div>
    </div>
</section>
