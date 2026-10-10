<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\PreguntasFrecuentes;
use app\models\CategoriasFaq;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

class PreguntasFrecuentesController extends Controller
{
    
public function behaviors()
{
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::class,
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
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->role === 'admin';
                    },
                ],
            ],
        ],
    ];
}


public function actionAyuda()
{
    return $this->render('ayuda');
}
   public function actionIndex(): string
{
    $query = PreguntasFrecuentes::find()
        ->with('categoria')
        ->orderBy(['pregunta' => SORT_ASC]);

    $categoriaId = Yii::$app->request->get('categoria_id');

    if ($categoriaId !== null && $categoriaId !== '') {
        $query->andWhere(['categoria_id' => (int) $categoriaId]);
    }

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);

    $categorias = CategoriasFaq::find()
        ->orderBy(['categoria' => SORT_ASC])
        ->all();

    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'categorias' => $categorias,
        'categoriaId' => $categoriaId,
    ]);
}

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate(): string|\yii\web\Response
    {
        $model = new PreguntasFrecuentes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                'La pregunta frecuente se creó correctamente.'
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id): string|\yii\web\Response
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                'La pregunta frecuente se actualizó correctamente.'
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id): \yii\web\Response
    {
        $model = $this->findModel($id);
        $model->delete();

        Yii::$app->session->setFlash(
            'success',
            'La pregunta frecuente se eliminó correctamente.'
        );

        return $this->redirect(['index']);
    }

    protected function findModel(int $id): PreguntasFrecuentes
    {
        $model = PreguntasFrecuentes::findOne($id);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            'La pregunta frecuente solicitada no existe.'
        );
    }
}
