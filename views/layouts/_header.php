<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

$currentRoute = Yii::$app->controller->route;

$this->registerJsFile(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
    ['position' => \yii\web\View::POS_END]
);

$this->registerCssFile('@web/css/xxx.css');

?>

<header id="site-header">
    <nav class="professional-navbar">
        <div class="navbar-container">


        <a href="<?= Yii::$app->homeUrl ?>"
           class="brand"
           aria-label="Código de Ética - Inicio">
            <span class="brand-icon">
                <i class="fa-solid fa-scale-balanced"></i>
            </span>

            <span class="brand-text">
                <strong>INVESTIGACION CON ÉTICA</strong>
                <small>DIGITAL</small>
            </span>
        </a>

        <button
            type="button"
            class="navbar-toggle"
            id="navbar-toggle"
            aria-label="Abrir menú"
            aria-expanded="false"
            aria-controls="navbar-menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="navbar-menu" id="navbar-menu">
            <ul class="navbar-links">

                <li>
                    <a href="<?= Yii::$app->homeUrl ?>"
                       class="<?= $currentRoute === 'site/index' ? 'active' : '' ?>">
                        <i class="fa-solid fa-house"></i>
                        <span>Inicio</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/about']) ?>"
                       class="<?= $currentRoute === 'site/about' ? 'active' : '' ?>">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>Nosotros</span>
                    </a>
                </li>

                

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/servicios']) ?>"
                       class="<?= $currentRoute === 'site/servicios' ? 'active' : '' ?>">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Servicios</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/videos']) ?>"
                       class="<?= $currentRoute === 'site/videos' ? 'active' : '' ?>">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>Blog</span>
                    </a>
                </li>

            </ul>

            <div class="navbar-actions">

                

                <span class="navbar-divider"></span>

                <?php if (Yii::$app->user->isGuest): ?>

                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/login']) ?>"
                       class="login-button">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Iniciar sesión</span>
                    </a>

                <?php else: ?>

                    <div class="dropdown user-dropdown">

                        <button
                            type="button"
                            class="user-dropdown-toggle"
                            id="userDropdown"
                            data-bs-toggle="dropdown"
                            data-bs-auto-close="true"
                            aria-expanded="false">

                            <span class="user-avatar">
                                <i class="fa-solid fa-user"></i>
                            </span>

                            <span class="user-name">
                                <?= Html::encode(
                                    Yii::$app->user->identity?->username ?? 'Usuario'
                                ) ?>
                            </span>

                            <i class="fa-solid fa-chevron-down user-arrow"></i>
                        </button>

                        <ul
                            class="dropdown-menu dropdown-menu-end user-dropdown-menu"
                            aria-labelledby="userDropdown">

                            <li>
                                <?= Html::a(
                                    '<i class="fa-solid fa-user-pen"></i> <span>Editar mis datos</span>',
                                    [
                                        '/user/update',
                                        'id' => Yii::$app->user->id,
                                    ],
                                    [
                                        'class' => 'dropdown-item',
                                        'encode' => false,
                                    ]
                                ) ?>
                            </li>

                            <li>
                                <?= Html::a(
                                    '<i class="fa-solid fa-key"></i> <span>Cambiar contraseña</span>',
                                    ['/user/change-password'],
                                    [
                                        'class' => 'dropdown-item',
                                        'encode' => false,
                                    ]
                                ) ?>
                            </li>
                           <?php if (
    !Yii::$app->user->isGuest &&
    Yii::$app->user->identity->role === 'admin'
): ?>
    <li>
        <?= Html::a(
            '<i class="fa-solid fa-key"></i> <span>Gestionar usuario</span>',
            ['/user/index'],
            [
                'class' => 'dropdown-item',
                'encode' => false,
            ]
        ) ?>
    </li>
<?php endif; ?>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <?= Html::beginForm(
                                    ['/site/logout'],
                                    'post',
                                    ['class' => 'logout-form']
                                ) ?>

                                <?= Html::submitButton(
                                    '<i class="fa-solid fa-right-from-bracket"></i> <span>Cerrar sesión</span>',
                                    [
                                        'class' => 'dropdown-item logout-item',
                                        'encode' => false,
                                    ]
                                ) ?>

                                <?= Html::endForm() ?>
                            </li>

                        </ul>
                    </div>

                <?php endif; ?>

                <button
                    type="button"
                    id="theme-toggle"
                    class="theme-toggle"
                    aria-label="Cambiar tema"
                    title="Cambiar tema">
                    <i class="fa-solid fa-moon"></i>
                </button>

            </div>
        </div>
    </div>

    <div id="search-panel" class="search-panel">
        <div class="search-container">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="search"
                id="site-search"
                placeholder="¿Qué deseas buscar?"
                autocomplete="off">

            <button
                type="button"
                id="search-close"
                aria-label="Cerrar búsqueda"
                title="Cerrar">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</nav>


</header>

<?php

$this->registerJs(<<<'JS'
document.addEventListener('DOMContentLoaded', function () {

    const navbarToggle = document.getElementById('navbar-toggle');
    const navbarMenu = document.getElementById('navbar-menu');

    if (navbarToggle && navbarMenu) {
        navbarToggle.addEventListener('click', function () {
            const isOpen = navbarMenu.classList.toggle('active');
            navbarToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        document.querySelectorAll('#navbar-menu .navbar-links a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 800) {
                    navbarMenu.classList.remove('active');
                    navbarToggle.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }

    const searchToggle = document.getElementById('search-toggle');
    const searchPanel = document.getElementById('search-panel');
    const searchClose = document.getElementById('search-close');
    const searchInput = document.getElementById('site-search');

    if (searchToggle && searchPanel) {
        searchToggle.addEventListener('click', function () {
            searchPanel.classList.toggle('active');

            if (searchPanel.classList.contains('active') && searchInput) {
                searchInput.focus();
            }
        });
    }

    if (searchClose && searchPanel) {
        searchClose.addEventListener('click', function () {
            searchPanel.classList.remove('active');
        });
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && searchPanel) {
            searchPanel.classList.remove('active');
        }
    });

    const themeToggle = document.getElementById('theme-toggle');

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            document.documentElement.classList.toggle('dark-mode');

            const icon = themeToggle.querySelector('i');

            if (!icon) {
                return;
            }

            const isDark = document.documentElement.classList.contains('dark-mode');

            icon.classList.toggle('fa-sun', isDark);
            icon.classList.toggle('fa-moon', !isDark);
        });
    }

});
JS);

?>
