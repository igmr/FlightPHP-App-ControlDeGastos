<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= Flight::get('flight.base_url') ?>/public/assets/bulma/css/bulma.css ">
        <link rel="stylesheet" href="<?= Flight::get('flight.base_url') ?>/public/assets/fontawesome/css/all.css">
        <link rel="stylesheet" href="<?= Flight::get('flight.base_url') ?>/public/assets/app.css">
        <?php foreach ($styles as $style) { ?>
        <link rel="stylesheet" href="<?= Flight::get('flight.base_url') ?>/public/<?=  $style ?>.css">
        <?php } ?>
        <title><?= $title ?></title>
    </head>
    <body class="is-family-monospace">

        <!-- Modal -->
        <div class="modal" id="modal-notification">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head has-background-danger-dark">
                    <p class="modal-card-title has-text-white modal-title"></p>
                </header>
                <section class="modal-card-body modal-body">
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-danger" id="btnDelete">
                        <i class="fa-solid fa-check"></i>&nbsp;Yes
                    </button>
                    <button class="button" id="btnCancelDelete">
                        <i class="fa-solid fa-ban"></i>&nbsp;Cancel
                    </button>
                </footer>
            </div>
        </div>
        <!-- End Modal -->

        <!-- NavBar -->
        <nav class="navbar has-shadow is-warning" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="<?= Flight::get('flight.base_url') ?>">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </span>
                        <span>
                        Control de gastos
                        </span>
                    </span>
                </a>
                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="navbar" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="<?= Flight::get('flight.base_url') ?>/">
                        Dashboard
                    </a>
                    <a class="navbar-item" href="<?= Flight::get('flight.base_url') ?>/subclassification">
                        Subclassification
                    </a>
                    <a class="navbar-item" href="<?= Flight::get('flight.base_url') ?>/classification">
                        Classification
                    </a>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary is-outlined"
                                href="https://github.com/igmr/FlightPHP-App-ControlDeGastos"
                                target="_blank">
                                GitHub APP
                            </a>
                            <a class="button is-primary is-outlined"
                                href="https://github.com/igmr/Lumen-Api-REST-ControlDeGastos"
                                target="_blank">
                                GitHub API
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- End NavBar -->


        <!-- Container -->
        <main class="container">
            <?= $content ?>
        </main>
        <!-- End Container -->


        <!-- Footer -->
        <footer class="footer">
            <div class="content has-text-centered">
                <p>FontEnd | <strong>FlightPHP</strong> - <strong>Bulma Framework</strong> - </p>
                <p>BackEnd | <strong>Lumen Framework</strong> - <strong>MySQL</strong></p>
            </div>
        </footer>
        <!-- End Footer -->

        <script src="<?= Flight::get('flight.base_url') ?>/public/assets/fontawesome/js/all.js"></script>
        <script src="<?= Flight::get('flight.base_url') ?>/public/assets/app.js"></script>

        <?php foreach ($scripts as $script) { ?>
        <script src="<?= Flight::get('flight.base_url') ?>/public/<?= $script ?>.js"></script>
        <?php } ?>

    </body>
</html>
