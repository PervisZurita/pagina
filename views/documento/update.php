<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\Documento $model */

use yii\helpers\Html;

$this->title = 'Editar documento';
$this->registerCssFile('@web/css/documentos.css');

?>

<div class="documento-administracion">
    <h1><i class="fa-solid fa-pen-to-square"></i> Editar documento</h1>
    <p>Actualiza la información o reemplaza el PDF.</p>

    <?= $this->render('_form', ['model' => $model]) ?>
</div>
