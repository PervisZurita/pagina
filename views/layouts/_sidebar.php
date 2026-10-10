<?php

declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;

$currentRoute = Yii::$app->controller->route;

$menuItems = [
    [
        'label' => 'Preguntas frecuentes',
        'icon' => 'fa-circle-question',
        'url' => ['/preguntas-frecuentes/index'],
    ],
    [
        'label' => 'Evaluación de conocimientos',
        'icon' => 'fa-pen-to-square',
        'url' => ['/cuestionario/realizar'],
    ],
    [
        'label' => 'Resultados del cuestionario',
        'icon' => 'fa-chart-column',
        'url' => ['/cuestionario/resultado'],
    ],
    [
        'label' => 'Estadísticas del cuestionario',
        'icon' => 'fa-chart-pie',
        'url' => ['/cuestionario/estadisticas'],
    ],
    [
        'label' => 'Foro de discusión',
        'icon' => 'fa-comments',
        'url' => ['/foro/index'],
    ],
    [
        'label' => 'Recursos y documentos',
        'icon' => 'fa-folder-open',
        'url' => ['/documento/index'],
    ],
    [
        'label' => 'Ayuda y orientación',
        'icon' => 'fa-life-ring',
        'url' => ['/preguntas-frecuentes/ayuda'],
    ],
];

?>

<aside class="sidebar" id="sidebar">

    <div class="sidebar-header">

        <button
            type="button"
            class="sidebar-toggle"
            id="sidebarToggle"
            aria-label="Contraer o expandir menú"
            aria-expanded="true"
            title="Contraer o expandir menú"
        >
            <i class="fa-solid fa-bars"></i>
        </button>

        <span class="sidebar-title">MENÚ PRINCIPAL</span>

    </div>

    <nav class="sidebar-menu" aria-label="Menú principal">

        <?php foreach ($menuItems as $item): ?>

            <?php
            $url = Url::to($item['url']);
            $route = ltrim($item['url'][0], '/');

            $active = $currentRoute === $route
                || str_starts_with($currentRoute, $route . '/');
            ?>

            <?= Html::a(
                '<i class="fa-solid ' . Html::encode($item['icon']) . '"></i>'
                . '<span class="sidebar-label">'
                . Html::encode($item['label'])
                . '</span>',
                $url,
                [
                    'class' => 'sidebar-link' . ($active ? ' active' : ''),
                    'title' => $item['label'],
                    'encode' => false,
                    'aria-current' => $active ? 'page' : null,
                ]
            ) ?>

        <?php endforeach; ?>

    </nav>

    <div class="sidebar-footer">
        <span class="sidebar-footer-text">
            Ética en la investigación científica
        </span>
    </div>

</aside>

<?php

$this->registerJs(<<<JS
(function () {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');

    if (!sidebar || !toggle) {
        return;
    }

    toggle.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();

        sidebar.classList.toggle('sidebar-expanded');
        document.body.classList.toggle('sidebar-is-collapsed');

        const expanded = !sidebar.classList.contains('sidebar-expanded');

        toggle.setAttribute('aria-expanded', String(expanded));
    });
})();
JS);

?>
