<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\Documento $model */

use yii\helpers\Html;

$this->title = 'Agregar documento';
$this->registerCssFile('@web/css/documentos.css');

?>

<div class="documento-administracion">
    <h1><i class="fa-solid fa-file-circle-plus"></i> Agregar documento</h1>
    <p>Completa los datos y selecciona el archivo PDF.</p>

    <?= $this->render('_form', ['model' => $model]) ?>
</div>