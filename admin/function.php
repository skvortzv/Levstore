<?php

function first_entry() {
    ?>
<section class="admin-form">
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input type="text" name="namelogin" class="form-control mb-2" id="inlineFormInput" placeholder="Name" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="passlogin" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off" required>
            </div>
            <button type="submit" name="login" class="btn">Submit</button>
        </form>
    </div>
</section>
<?php
}

function login_verification($session_name, $session_pass, $username, $password) {
    if($session_name == $username && $session_pass == $password) {
        return(1);
    } else {
        return(2);
    }
}

function remove_product($server, $user, $pass, $dbname) {
    $id = htmlspecialchars($_POST['remove-product']);
    $tmp_name = htmlspecialchars($_POST['tmp-name']);
    
    try {
        $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DELETE FROM `products` WHERE id = '$id'";
        $conn->exec($sql);
        
        $conn = null;
    } catch (PDOException $e) {
        ?><p style = "color: red;"><?php echo "Error: " . $e->getMessage();?></p>
    <?php
        $conn = null;
    }
    
    unlink("../images/products/$tmp_name.jpg");
}

function add_product_sql($server, $user, $pass, $dbname) {
    $tmp_name = htmlspecialchars($_FILES["img-product"]["tmp_name"]);
    $nametmpimg = mt_rand(-1000000, 10000000);
    move_uploaded_file($tmp_name, "../images/products/$nametmpimg.jpg");

    $name_product = htmlspecialchars($_POST['name-product']);
    $description_product = htmlspecialchars($_POST['description-product']);
    $price_product = htmlspecialchars($_POST['price-product']);

    // Пытаемся создать бд
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
        ?><p style = "color: red;"><?php echo "Error: " . $e->getMessage();?></p>
    <?php
        $conn = null;
    }

    try {
        //Заново подключаемся к серверу + бд
        $conn = new PDO("mysql:host=$server;dbname=$dbname", "$user", "$pass");

        $sql = "CREATE TABLE IF NOT EXISTS `products` (
        `id` int(11) NOT NULL,
        `img-path` varchar(256) NOT NULL,
        `name` varchar(256) NOT NULL,
        `description` longtext NOT NULL,
        `price` int(11) NOT NULL);";
        // выполняем SQL-выражение
        $conn->exec($sql);

        $sql = "ALTER TABLE `products` ADD PRIMARY KEY (`id`);";
        $conn->exec($sql);

        $sql = "ALTER TABLE `products` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
        $conn->exec($sql);

        // Обязательно после всего выходим с сервера
        $conn = null;
    } catch (PDOException $e) {
        ?><p style = "color: red;"><?php echo "Error: " . $e->getMessage();?></p>
    <?php
        $conn = null;
    }

    try {
        //Заново подключаемся к серверу + бд
        $conn = new PDO("mysql:host=$server;dbname=$dbname", "$user", "$pass");

        $sql = "INSERT INTO `products` (`img-path`, `name`, `description`, `price`) VALUES ('$nametmpimg', '$name_product', '$description_product', '$price_product');";
        $conn->exec($sql);

        $conn = null;

        ?><p style = "color: green;">Успешно</p>
    <?php
    } catch (PDOException $e) {
        ?><p style = "color: red;"><?php echo "Error: " . $e->getMessage();?></p>
    <?php
        $conn = null;
    }
}

function add_product($server, $user, $pass, $dbname) {
    ?>

<form class="form-add-product" action = "" method = "post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleFormControlFile1">Фото (JPEG, JPG) *</label>
        <input type="file" name="img-product" class="form-control-file" id="exampleFormControlFile1" accept=".jpg, .jpeg" required>
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput">Название товара *</label>
        <input type="text" name="name-product" class="form-control" id="formGroupExampleInput" placeholder="Название товара" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Описание товара *</label>
        <textarea name="description-product" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput">Цена в рублях *</label>
        <input type="number" name="price-product" class="form-control" id="formGroupExampleInput" placeholder="₽" required>
    </div>
    <button type="submit" name="add-product-sql" class="btn btn-success">Добавить товар</button>
</form>

<?php
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

<article class = "product">
    <img src = "../images/products/<?php print($row['img-path']); ?>.jpg">
    <p class = "product-name"><?php print($row['name']); ?></p>
    <p class = "product-description"><?php print($row['description']); ?></p>
    <p class = "product-price"><?php print($row['price']); ?> ₽</p>
    <form action = "" method = "post" style = "margin: 0;">
        <input name = "tmp-name" value="<?php print($row['img-path']); ?>" readonly style = "width: 0; height: 0;">
        <button name = "remove-product" value = "<?php print($row['id']); ?>" type="submit" class="btn btn-danger">УДАЛИТЬ</button>
    </form>
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

function remove_order($server, $user, $pass, $dbname) {
    $id = htmlspecialchars($_POST['remove-order']);
    try {
        $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DELETE FROM `orders` WHERE id = '$id'";
        $conn->exec($sql);
        
        $conn = null;
    } catch (PDOException $e) {
        ?><p style = "color: red;"><?php echo "Error: " . $e->getMessage();?></p>
    <?php
        $conn = null;
    }
}

function output_request($server, $user, $pass, $dbname) {
    try {
        $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Обработка всего введенного предложения
        $sql = $conn->prepare('SELECT * FROM `orders`');
        $sql->execute();

        $result = $sql->fetchAll();

        if(count($result)) {
            foreach($result as $row) {
                ?>

<article class = "order_admin">
    <p><?php print($row['name']); ?></p>
    <p><?php print($row['number']); ?></p>
    <p><?php print($row['product']); ?></p>
    <form action = "" method = "post">
        <button name = "remove-order" value = "<?php print($row['id']); ?>" type="submit" class="btn btn-danger">удалить заявку</button>
    </form>
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

function remove_review($server, $user, $pass, $dbname) {
    $id = htmlspecialchars($_POST['remove-review']);
    try {
        $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DELETE FROM `reviews` WHERE id = '$id'";
        $conn->exec($sql);
        
        $conn = null;
    } catch (PDOException $e) {
        ?><p style = "color: red;"><?php echo "Error: " . $e->getMessage();?></p>
    <?php
        $conn = null;
    }
}

function output_reviews($server, $user, $pass, $dbname) {
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
                ?>

<article class = "review_admin">
    <p><?php print($row['name']); ?></p>
    <p><?php print($row['product']); ?></p>
    <p><?php print($row['reviews']); ?></p>
    <form action = "" method = "post">
        <button name = "remove-review" value = "<?php print($row['id']); ?>" type="submit" class="btn btn-danger">удалить отзыв</button>
    </form>
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

function exit_admin() {
    session_destroy();
    header('location: ../');
    exit();
}

function logged_in($server, $user, $pass, $dbname) {
    ?>

<section class="admin-panel">
    <div class="container">
        <form action="" method="post">
            <button type="submit" name="add-product" class="btn btn-light">Добавить или удалить товар</button>
            <button type="submit" name="request" class="btn btn-light">Заявки</button>
            <button type="submit" name="edit-reviews" class="btn btn-light">Отзывы</button>
            <button type="submit" name="exit" class="btn btn-danger">Выйти</button>
        </form>
        <?php
        
    if(isset($_POST['add-product'])) add_product($server, $user, $pass, $dbname);
    if(isset($_POST['request'])) output_request($server, $user, $pass, $dbname);
    if(isset($_POST['edit-reviews'])) output_reviews($server, $user, $pass, $dbname);
    if(isset($_POST['exit'])) exit_admin();
    
        ?>
    </div>
</section>

<?php
    if(isset($_POST['add-product-sql'])) add_product_sql($server, $user, $pass, $dbname);
    if(isset($_POST['remove-product'])) remove_product($server, $user, $pass, $dbname);
    if(isset($_POST['remove-order'])) remove_order($server, $user, $pass, $dbname);
    if(isset($_POST['remove-review'])) remove_review($server, $user, $pass, $dbname);
}
