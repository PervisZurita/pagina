<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\Categorias2;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class Categorias2Controller extends Controller
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
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
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
            'query' => Categorias2::find()
                ->with('codigoEticas')
                ->orderBy(['nombre' => SORT_ASC]),
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
        $model = new Categorias2();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                'La categoría se creó correctamente.'
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                'La categoría se actualizó correctamente.'
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);

        if ($model->getCodigoEticas()->exists()) {
            Yii::$app->session->setFlash(
                'error',
                'No se puede eliminar la categoría porque tiene artículos asociados.'
            );

            return $this->redirect(['index']);
        }

        $model->delete();

        Yii::$app->session->setFlash(
            'success',
            'La categoría se eliminó correctamente.'
        );

        return $this->redirect(['index']);
    }

    protected function findModel(int $id): Categorias2
    {
        $model = Categorias2::findOne($id);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            'La categoría solicitada no existe.'
        );
    }
}
