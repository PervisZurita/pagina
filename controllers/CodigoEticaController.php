<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\CodigoEtica2;
use app\models\Categorias2;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

class CodigoEticaController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'index',
                    'view',
                    'create',
                    'update',
                    'delete',
                    'categoria',
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'categoria'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['@'],
                        'matchCallback' => static function (): bool {
                            return Yii::$app->user->identity->role === 'admin';
                        },
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CodigoEtica2::find()
                ->with('categoria')
                ->orderBy(['id' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new CodigoEtica2();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                'El artículo del Código de Ética se creó correctamente.'
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categorias' => Categorias2::find()
                ->orderBy(['nombre' => SORT_ASC])
                ->all(),
        ]);
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                'El artículo se actualizó correctamente.'
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categorias' => Categorias2::find()
                ->orderBy(['nombre' => SORT_ASC])
                ->all(),
        ]);
    }

    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash(
            'success',
            'El artículo se eliminó correctamente.'
        );

        return $this->redirect(['index']);
    }

    public function actionCategoria(int $id): string
    {
        $categoria = Categorias2::findOne($id);

        if ($categoria === null) {
            throw new NotFoundHttpException(
                'La categoría solicitada no existe.'
            );
        }

        $dataProvider = new ActiveDataProvider([
            'query' => CodigoEtica2::find()
                ->where(['categoria_id' => $id])
                ->orderBy(['id' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('categoria', [
            'categoria' => $categoria,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findModel(int $id): CodigoEtica2
    {
        $model = CodigoEtica2::findOne($id);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            'El artículo solicitado no existe.'
        );
    }
}
