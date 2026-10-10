<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\PreguntasFrecuentes $model */

use yii\helpers\Html;

$this->title = 'Actualizar pregunta frecuente';

$this->registerCssFile('@web/css/paginacion.css');

?>

<div class="faq-container">

    <div class="faq-header">
        <div class="faq-header-icon">
            <i class="fas fa-pen-to-square"></i>
        </div>

        <h1>Actualizar pregunta frecuente</h1>

        <p>
            Modifica la pregunta, su respuesta o la categoría
            y guarda los cambios realizados.
        </p>
    </div>

    <div class="faq-table-card faq-create-card">

        <div class="faq-table-heading">
            <div>
                <h2>
                    <i class="fas fa-edit"></i>
                    Editar información
                </h2>

                <p>
                    Actualiza los campos que necesites.
                </p>
            </div>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</div>
