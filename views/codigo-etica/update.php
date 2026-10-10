<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\CodigoEtica2 $model */
/** @var app\models\Categorias2[] $categorias */

use yii\helpers\Html;

$this->title = 'Editar artículo';

$this->registerCssFile('@web/css/codigo-etica.css');

?>

<div class="administrar-codigo">

    <div class="administrar-codigo-header">
        <i class="fa-solid fa-pen-to-square"></i>

        <div>
            <h1>Editar artículo</h1>
            <p>Modifica el título, contenido o capítulo del artículo.</p>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
    ]) ?>

</div>
