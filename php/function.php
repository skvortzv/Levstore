<?php

function send($id, $name, $number, $work_mail, $server, $dbname, $user, $pass) {
    if($id == -1) {
        try {
            // подключаемся к серверу
            $conn = new PDO("mysql:host=$server", "$user", "$pass");

            // SQL создаем основную базу данных
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            // выполняем SQL-выражение
            $conn->exec($sql);

            // Обязательно после всего выходим с сервера
            $conn = null;
        } catch (PDOException $e) {
            $conn = null;
        }
        
        try {
            //Заново подключаемся к серверу + бд
            $conn = new PDO("mysql:host=$server;dbname=$dbname", "$user", "$pass");

            $sql = "CREATE TABLE IF NOT EXISTS `orders` (
            `id` int(11) NOT NULL,
            `name` varchar(256) NOT NULL,
            `number` varchar(256) NOT NULL,
            `product` varchar(256) NOT NULL);";
            // выполняем SQL-выражение
            $conn->exec($sql);

            $sql = "ALTER TABLE `orders` ADD PRIMARY KEY (`id`);";
            $conn->exec($sql);

            $sql = "ALTER TABLE `orders` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
            $conn->exec($sql);

            // Обязательно после всего выходим с сервера
            $conn = null;
        } catch (PDOException $e) {
            $conn = null;
        }
        
        try {
            //Заново подключаемся к серверу + бд
            $conn = new PDO("mysql:host=$server;dbname=$dbname", "$user", "$pass");

            $product = 'Консультация';
            
            $sql = "INSERT INTO `orders` (`name`, `number`, `product`) VALUES ('$name', '$number', '$product');";
            $conn->exec($sql);

            $conn = null;
        } catch (PDOException $e) {
            $conn = null;
        }
        
        $to      = "$work_mail";
        $subject = 'Поступил заказ!';
        $message = "Поступил заказ от: $name, с номера: $number, с просьбой перезвонить для консультации!";
        $headers = "From: $work_mail"       . "\r\n" .
                     "Reply-To: $work_mail" . "\r\n" .
                     'X-Mailer: PHP/' . phpversion();

        if(mail($to, $subject, $message, $headers)) {
            echo "Телефон успешно отправлен. Ожидайте звонка";
        } else {
            echo "Ошибка отправки";
        }
        
    } else {
        $product = "";
        
        try {
            $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Обработка всего введенного предложения
            $sql = $conn->prepare('SELECT * FROM `products`');
            $sql->execute();

            $result = $sql->fetchAll();
            
            if(count($result)) {
                foreach($result as $row) {
                    if($id == $row['id']) $product = $row['name'];
                }
            }
        } catch (PDOException $e) {
            $conn = null;
        }
        
        try {
            // подключаемся к серверу
            $conn = new PDO("mysql:host=$server", "$user", "$pass");

            // SQL создаем основную базу данных
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            // выполняем SQL-выражение
            $conn->exec($sql);

            // Обязательно после всего выходим с сервера
            $conn = null;
        } catch (PDOException $e) {
            $conn = null;
        }
        
        try {
            //Заново подключаемся к серверу + бд
            $conn = new PDO("mysql:host=$server;dbname=$dbname", "$user", "$pass");

            $sql = "CREATE TABLE IF NOT EXISTS `orders` (
            `id` int(11) NOT NULL,
            `name` varchar(256) NOT NULL,
            `number` varchar(256) NOT NULL,
            `product` varchar(256) NOT NULL);";
            // выполняем SQL-выражение
            $conn->exec($sql);

            $sql = "ALTER TABLE `orders` ADD PRIMARY KEY (`id`);";
            $conn->exec($sql);

            $sql = "ALTER TABLE `orders` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
            $conn->exec($sql);

            // Обязательно после всего выходим с сервера
            $conn = null;
        } catch (PDOException $e) {
            $conn = null;
        }
        
        try {
            //Заново подключаемся к серверу + бд
            $conn = new PDO("mysql:host=$server;dbname=$dbname", "$user", "$pass");
            
            $sql = "INSERT INTO `orders` (`name`, `number`, `product`) VALUES ('$name', '$number', '$product');";
            $conn->exec($sql);

            $conn = null;
        } catch (PDOException $e) {
            $conn = null;
        }
        
        $to      = "$work_mail";
        $subject = 'Поступил заказ!';
        $message = "Поступил заказ от: $name, с номера: $number, с просьбой перезвонить для консультации!";
        $headers = "From: $work_mail"       . "\r\n" .
                     "Reply-To: $work_mail" . "\r\n" .
                     'X-Mailer: PHP/' . phpversion();

        if(mail($to, $subject, $message, $headers)) {
            echo "Телефон успешно отправлен. Ожидайте звонка";
        } else {
            echo "Ошибка отправки";
        }
    }
}

function products_output($work_mail, $server, $dbname, $user, $pass) {
    try {
        $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Обработка всего введенного предложения
        $sql = $conn->prepare('SELECT * FROM `products`');
        $sql->execute();

        $result = $sql->fetchAll();
        
        if(count($result)) {
            foreach($result as $row) {
                ?>

    <div class="modal fade" id="productModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <button type="submit" name="btn-order-product" value = "<?php print($row['id']); ?>" class="btn btn-success">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <article class="product">
        <img src="images/products/<?php print($row['img-path']); ?>.jpg">
        <p class="product-name"><?php print($row['name']); ?></p>
        <p class="product-description"><?php print($row['description']); ?></p>
        <p class="product-price"><?php print($row['price']); ?> ₽</p>
        <button data-toggle="modal" data-target="#productModalCenter" type="submit" class="btn btn-success">ЗАКАЗАТЬ</button>
    </article>

    <?php
            }
        }

        $conn = null;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        $conn = null;
    }
}

function add_reviews($server, $user, $pass, $dbname) {
    $name_reviews = htmlspecialchars($_POST['name-reviews']);
    $product_reviews = htmlspecialchars($_POST['product-reviews']);
    $text_reviews = htmlspecialchars($_POST['text-reviews']);
    
    try {
        // подключаемся к серверу
        $conn = new PDO("mysql:host=$server", "$user", "$pass");

        // SQL создаем основную базу данных
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        // выполняем SQL-выражение
        $conn->exec($sql);

        // Обязательно после всего выходим с сервера
        $conn = null;
    } catch (PDOException $e) {
        $conn = null;
    }
    
    try {
        //Заново подключаемся к серверу + бд
        $conn = new PDO("mysql:host=$server;dbname=$dbname", "$user", "$pass");

        $sql = "CREATE TABLE IF NOT EXISTS `reviews` (
        `id` int(11) NOT NULL,
        `name` varchar(256) NOT NULL,
        `product` varchar(256) NOT NULL,
        `reviews` longtext NOT NULL);";
        // выполняем SQL-выражение
        $conn->exec($sql);

        $sql = "ALTER TABLE `reviews` ADD PRIMARY KEY (`id`);";
        $conn->exec($sql);

        $sql = "ALTER TABLE `reviews` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
        $conn->exec($sql);

        // Обязательно после всего выходим с сервера
        $conn = null;
    } catch (PDOException $e) {
        $conn = null;
    }
    
    try {
        //Заново подключаемся к серверу + бд
        $conn = new PDO("mysql:host=$server;dbname=$dbname", "$user", "$pass");

        $sql = "INSERT INTO `reviews` (`name`, `product`, `reviews`) VALUES ('$name_reviews', '$product_reviews', '$text_reviews');";
        $conn->exec($sql);

        echo "Отзыв добавлен";

        $conn = null;
    } catch (PDOException $e) {
        $conn = null;
    }
}

function reviews_output($server, $dbname, $user, $pass) {
    try {
        $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Обработка всего введенного предложения
        $sql = $conn->prepare('SELECT * FROM `reviews`');
        $sql->execute();

        $result = $sql->fetchAll();

        if(count($result)) {
            foreach($result as $row) {
                if(!isset($_GET['more'])) {
                    if($row['id'] <= 3) {
                        ?>

        <article class="review">
            <p><?php print($row['name']); ?></p>
            <p><?php print($row['product']); ?></p>
            <p class="review-text"><?php print($row['reviews']); ?></p>
        </article>

                        <?php
                    }
                } else if(isset($_GET['more'])) {
                    ?>

        <article class="review">
            <p><?php print($row['name']); ?></p>
            <p><?php print($row['product']); ?></p>
            <p class="review-text"><?php print($row['reviews']); ?></p>
        </article>

                    <?php
                }
            }
        }

        $conn = null;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        $conn = null;
    }
}