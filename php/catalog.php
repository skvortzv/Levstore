

<section class="catalog" id="margin-to-catalog">
    <div class="container" id="catalog">
        <hr>
        <h1>КАТАЛОГ</h1>
        <p><?php if(isset($_POST['btn-order-product'])) send(htmlspecialchars($_POST['btn-order-product']), htmlspecialchars($_POST['order-name']), htmlspecialchars($_POST['order-number']), $work_mail, $server, $dbname, $user, $pass); ?></p>
        <div class="center-products">
            <div class="grid-products">
                <?php products_output($work_mail, $server, $dbname, $user, $pass); ?>
            </div>
        </div>
    </div>
</section>
