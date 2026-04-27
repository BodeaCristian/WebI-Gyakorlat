<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MVC - PHP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
    </head>
    <body class="app-body">
        <header class="app-header py-3 py-md-4">
            <div class="container">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                    <h1 class="header m-0">ReNew Kft. - Felújított notebookok</h1>
                    <div id="user" class="small"><em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname'] ?></em></div>
                </div>
            </div>
        </header>
        <nav class="app-nav py-2">
            <div class="container">
                <?php echo Menu::getMenu($viewData['selectedItems']); ?>
            </div>
        </nav>

        <main class="container py-4">
            <div class="row g-4">
                <aside class="col-12 col-lg-3">
                    <div class="partner-links d-flex d-lg-block gap-2 gap-lg-0">
                        <a href="https://www.uni-neumann.hu" target="_blank" class="partner-card"><img src="<?=SITE_ROOT?>images/nje.png" alt="NJE"></a>
                        <a href="https://neptun.uni-neumann.hu" target="_blank" class="partner-card"><img src="<?=SITE_ROOT?>images/neptun.png" alt="Neptun"></a>
                        <a href="https://gamf.uni-neumann.hu" target="_blank" class="partner-card"><img src="<?=SITE_ROOT?>images/gamf.png" alt="GAMF"></a>
                    </div>
                </aside>

                <section class="col-12 col-lg-9 content-panel">
                    <?php if($viewData['render']) include($viewData['render']); ?>
                </section>
            </div>
        </main>

        <footer class="app-footer py-3">
            <div class="container small">&copy; Web1 Gyakorlat Beadandó | Bodea Cristian HPWI6J | Kátai Csaba JYPMZB</div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
