<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Gestión de Usuarios';


/* CSS específico de esta página */
$this->registerCss(<<<'CSS'

/* =========================================================
   PANEL DE USUARIOS
========================================================= */

.user-index {
    padding: 30px 10px 50px;
}

/* Encabezado */
.users-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;

    margin-bottom: 30px;
    padding: 30px;

    background: linear-gradient(
        135deg,
        #0f172a,
        #1e3a8a
    );

    border-radius: 18px;

    color: white;

    box-shadow: 0 12px 35px rgba(15, 23, 42, 0.18);
}

.users-header-content {
    display: flex;
    align-items: center;
    gap: 18px;
}

.users-header-icon {
    width: 65px;
    height: 65px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 16px;

    background: rgba(255,255,255,.15);

    font-size: 28px;
}

.users-header h1 {
    margin: 0 0 5px;
    font-size: 28px;
    font-weight: 700;
}

.users-header p {
    margin: 0;
    color: rgba(255,255,255,.75);
    font-size: 14px;
}

/* Botón crear */
.btn-create-user {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    padding: 12px 18px;

    border-radius: 10px;

    background: #ffffff;
    color: #1e3a8a;

    font-weight: 600;

    text-decoration: none;

    transition: all .25s ease;
}

.btn-create-user:hover {
    background: #f8fafc;
    color: #1d4ed8;

    transform: translateY(-2px);

    box-shadow: 0 8px 20px rgba(0,0,0,.15);
}

/* =========================================================
   TARJETA PRINCIPAL
========================================================= */

.users-card {
    background: #ffffff;

    border-radius: 18px;

    border: 1px solid #e5e7eb;

    box-shadow: 0 8px 30px rgba(15,23,42,.07);

    overflow: hidden;
}

/* Cabecera de la tabla */
.users-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 20px 24px;

    border-bottom: 1px solid #e5e7eb;

    background: #f8fafc;
}

.users-card-title {
    display: flex;
    align-items: center;
    gap: 10px;

    margin: 0;

    font-size: 17px;
    font-weight: 700;

    color: #0f172a;
}

.users-card-title i {
    color: #2563eb;
}

/* =========================================================
   GRIDVIEW
========================================================= */

.users-table-wrapper {
    overflow-x: auto;
}

.users-table {
    margin: 0 !important;
    border-collapse: separate !important;
    border-spacing: 0;
}

/* Encabezados */
.users-table thead th {
    padding: 15px 18px;

    background: #f8fafc;

    color: #64748b;

    font-size: 12px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: .5px;

    border-bottom: 1px solid #e2e8f0;
}

.users-table thead th a {
    color: #475569;
    text-decoration: none;
}

.users-table thead th a:hover {
    color: #2563eb;
}

/* Celdas */
.users-table tbody td {
    padding: 15px 18px;

    vertical-align: middle;

    color: #334155;

    border-bottom: 1px solid #f1f5f9;

    font-size: 14px;
}

/* Hover */
.users-table tbody tr {
    transition: all .2s ease;
}

.users-table tbody tr:hover {
    background: #f8fafc;
}

/* =========================================================
   USUARIO
========================================================= */

.username-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #dbeafe;

    color: #2563eb;

    font-size: 15px;
}

/* =========================================================
   ROLES
========================================================= */

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 6px 11px;

    border-radius: 20px;

    font-size: 12px;
    font-weight: 700;

    text-transform: capitalize;
}

.role-admin {
    background: #fee2e2;
    color: #b91c1c;
}

.role-user {
    background: #dcfce7;
    color: #15803d;
}

.role-default {
    background: #e2e8f0;
    color: #475569;
}

/* =========================================================
   BOTONES DE ACCIÓN
========================================================= */

.user-actions {
    display: flex;
    align-items: center;
    gap: 6px;
}

.user-actions .btn {
    width: 34px;
    height: 34px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border-radius: 8px;

    border: none;

    transition: all .2s ease;
}

.user-actions .btn:hover {
    transform: translateY(-2px);
}

/* Ver */
.btn-view {
    background: #dbeafe;
    color: #2563eb;
}

/* Editar */
.btn-update {
    background: #fef3c7;
    color: #d97706;
}

/* Eliminar */
.btn-delete {
    background: #fee2e2;
    color: #dc2626;
}

/* Contraseña */
.btn-password {
    background: #ede9fe;
    color: #7c3aed;
}

/* =========================================================
   PAGINACIÓN
========================================================= */

.pagination {
    margin: 0;

    padding: 20px 24px;

    justify-content: flex-end;
}

.pagination li a,
.pagination li span {
    margin: 0 3px;

    border: none !important;

    border-radius: 8px !important;

    min-width: 36px;
    height: 36px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #475569;
}

.pagination li.active span {
    background: #2563eb;
    color: white;
}

.pagination li a:hover {
    background: #eff6ff;
    color: #2563eb;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .user-index {
        padding: 20px 5px;
    }

    .users-header {
        flex-direction: column;
        align-items: flex-start;
        padding: 22px;
    }

    .btn-create-user {
        width: 100%;
        justify-content: center;
    }

    .users-header h1 {
        font-size: 23px;
    }

    .users-card-header {
        padding: 16px;
    }

}

CSS);
?>

<div class="user-index">

    <!-- =====================================================
         ENCABEZADO
    ====================================================== -->

    <div class="users-header">

        <div class="users-header-content">

            <div class="users-header-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <div>

                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

                <p>
                    Administra las cuentas y permisos de los usuarios del sistema.
                </p>

            </div>

        </div>

        <?= Html::a(
            '<i class="fa-solid fa-user-plus"></i> Crear usuario',
            ['create'],
            [
                'class' => 'btn-create-user'
            ]
        ) ?>

    </div>


    <!-- =====================================================
         TABLA
    ====================================================== -->

    <div class="users-card">

        <div class="users-card-header">

            <h2 class="users-card-title">

                <i class="fa-solid fa-list"></i>

                Usuarios registrados

            </h2>

        </div>


        <div class="users-table-wrapper">

            <?= GridView::widget([

                'dataProvider' => $dataProvider,

                'tableOptions' => [
                    'class' => 'table users-table'
                ],

                'layout' =>
                    "{items}\n" .
                    "<div class='users-pagination'>{pager}</div>",

                'pager' => [
                    'options' => [
                        'class' => 'pagination'
                    ],

                    'prevPageLabel' => '<i class="fa-solid fa-chevron-left"></i>',
                    'nextPageLabel' => '<i class="fa-solid fa-chevron-right"></i>',
                ],

                'columns' => [

                    /* Número */
                    [
                        'class' => 'yii\grid\SerialColumn',

                        'header' => '#',

                        'contentOptions' => [
                            'style' => 'width:60px;'
                        ],
                    ],


                    /* USUARIO */
                    [
                        'attribute' => 'username',

                        'header' => 'Usuario',

                        'format' => 'raw',

                        'value' => function ($model) {

                            $username = Html::encode(
                                $model->username
                            );

                            $initial = strtoupper(
                                substr($model->username, 0, 1)
                            );

                            return '

                                <div class="username-cell">

                                    <div class="user-avatar">
                                        ' . $initial . '
                                    </div>

                                    <strong>
                                        ' . $username . '
                                    </strong>

                                </div>

                            ';
                        },
                    ],


                    /* ROL */
                    [
                        'attribute' => 'role',

                        'header' => 'Rol',

                        'format' => 'raw',

                        'value' => function ($model) {

                            $role = strtolower(
                                trim((string)$model->role)
                            );

                            if ($role === 'admin') {

                                $class = 'role-admin';

                                $icon = 'fa-shield-halved';

                            } elseif ($role === 'user') {

                                $class = 'role-user';

                                $icon = 'fa-user';

                            } else {

                                $class = 'role-default';

                                $icon = 'fa-user-tag';
                            }

                            return '

                                <span class="role-badge ' . $class . '">

                                    <i class="fa-solid ' . $icon . '"></i>

                                    ' . Html::encode($model->role) . '

                                </span>

                            ';
                        },
                    ],


                    /* ACCIONES */
                    [
                        'class' => 'yii\grid\ActionColumn',

                        'header' => 'Acciones',

                        'template' => '<div class="user-actions">
                                        {view}
                                        {update}
                                        {delete}
                                        {reset-password}
                                      </div>',

                        'buttons' => [

                            /* Ver */
                            'view' => function ($url) {

                                return Html::a(
                                    '<i class="fa-solid fa-eye"></i>',
                                    $url,
                                    [
                                        'class' => 'btn btn-view',
                                        'title' => 'Ver usuario',
                                        'data-bs-toggle' => 'tooltip'
                                    ]
                                );
                            },


                            /* Editar */
                            'update' => function ($url) {

                                return Html::a(
                                    '<i class="fa-solid fa-pen"></i>',
                                    $url,
                                    [
                                        'class' => 'btn btn-update',
                                        'title' => 'Editar usuario',
                                        'data-bs-toggle' => 'tooltip'
                                    ]
                                );
                            },


                            /* Eliminar */
                            'delete' => function ($url) {

                                return Html::a(
                                    '<i class="fa-solid fa-trash"></i>',
                                    $url,
                                    [
                                        'class' => 'btn btn-delete',

                                        'title' => 'Eliminar usuario',

                                        'data' => [
                                            'confirm' =>
                                                '¿Está seguro de que desea eliminar este usuario?',

                                            'method' => 'post',
                                        ],
                                    ]
                                );
                            },


                          
                                
                            

                        ],
                    ],

                ],

            ]); ?>

        </div>

    </div>

</div>