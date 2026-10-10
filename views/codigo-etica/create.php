<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\CodigoEtica2 $model */
/** @var app\models\Categorias2[] $categorias */

use yii\helpers\Html;

$this->title = 'Agregar artículo';

$this->registerCssFile('@web/css/codigo-etica.css');

?>

<div class="administrar-codigo">

    <div class="administrar-codigo-header">
        <i class="fa-solid fa-file-circle-plus"></i>

        <div>
            <h1>Agregar artículo</h1>
            <p>Registra un nuevo artículo en el Código de Ética.</p>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
    ]) ?>

</div>