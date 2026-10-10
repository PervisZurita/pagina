<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\PreguntasFrecuentes $model */

use yii\helpers\Html;

$this->title = 'Crear pregunta frecuente';

$this->registerCssFile('@web/css/paginacion.css');

?>

<div class="faq-container">

    <div class="faq-header">
        <div class="faq-header-icon">
            <i class="fas fa-circle-question"></i>
        </div>

        <h1>Crear pregunta frecuente</h1>

        <p>
            Registra una nueva pregunta y su respuesta
            para facilitar la consulta de información.
        </p>
    </div>

    <div class="faq-table-card faq-create-card">

        <div class="faq-table-heading">
            <div>
                <h2><i class="fas fa-file-circle-plus"></i> Información de la pregunta</h2>
                <p>Completa todos los campos obligatorios.</p>
            </div>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</div>
