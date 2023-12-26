<header>
    <div class = "container">
        <div class = "h-logo">
            <img src = "<?php print($_logo_path); ?>">
            <h1><?php print($_logo_text); ?></h1>
        </div>
        <div class = "h-description">
            <p><?php print($_description_text); ?></p>
        </div>
        <div class = "h-menu">
            <nav class = "nav">
                <a class="nav-link" href="index.php">ГЛАВНАЯ</a>
                <a class="nav-link" href="#about">О КОМПАНИИ</a>
                <a class="nav-link" href="#catalog">КАТАЛОГ</a>
                <a class="nav-link" href="#contacts">КОНТАКТЫ</a>
            </nav>
              <nav class="navbar navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              </nav>
        </div>
        <div class = "h-contacts">
            <h2><?php print($_contacts_number); ?></h2>
            <p><?php print($_contacts_worktime); ?></p>
        </div>
          <div class="collapse" id="navbarToggleExternalContent">
            <div class="p-4">
                <hr>
                <a class="nav-link" href="index.php">ГЛАВНАЯ</a>
                <a class="nav-link" href="#about">О КОМПАНИИ</a>
                <a class="nav-link" href="#catalog">КАТАЛОГ</a>
                <a class="nav-link" href="#contacts">КОНТАКТЫ</a>
                <hr>
                <p><?php print($_description_text); ?></p>
                <h2><?php print($_contacts_number); ?></h2>
                <p><?php print($_contacts_worktime); ?></p>
            </div>
          </div>
    </div>
</header>