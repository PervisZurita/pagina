<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\ChangePasswordForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UserController extends Controller
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
                'reset-password',
                'change-password',
            ],
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['create'],
                    'roles' => ['?'],
                ],
                [
                    'allow' => true,
                    'actions' => ['change-password'],
                    'roles' => ['@'],
                ],
                [
                    'allow' => true,
                    'actions' => ['update'],
                    'roles' => ['@'],
                ],
                [
                    'allow' => true,
                    'actions' => [
                        'index',
                        'view',
                        'delete',
                        'reset-password',
                    ],
                    'roles' => ['@'],
                    'matchCallback' => static function (): bool {
                        return Yii::$app->user->identity !== null
                            && Yii::$app->user->identity->role === 'admin';
                    },
                ],
            ],
        ],
        'verbs' => [
            'class' => VerbFilter::class,
            'actions' => [
                'delete' => ['POST'],
                'reset-password' => ['POST'],
                'change-password' => ['GET', 'POST'],
                'update' => ['GET', 'POST'],
            ],
        ],
    ];
}


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $model->role = 'user';

            if (empty($model->password)) {
                $model->addError(
                    'password',
                    'La contraseña es obligatoria.'
                );
            } else {
                $model->setPassword($model->password);
                $model->generateAuthKey();

                if ($model->save()) {
                    Yii::$app->session->setFlash(
                        'success',
                        'El usuario se creó correctamente.'
                    );

                    return $this->redirect([
                        'view',
                        'id' => $model->id,
                    ]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    
public function actionUpdate($id = null)
{
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['/site/login']);
    }

    $usuarioActual = Yii::$app->user->identity;
    $esAdmin = $usuarioActual->role === 'admin';

    // El administrador puede editar cualquier usuario.
    // El usuario normal solo puede editar su propia cuenta.
    if ($esAdmin) {
        $model = User::findOne($id);
    } else {
        $model = User::findOne($usuarioActual->id);
    }

    if ($model === null) {
        throw new \yii\web\NotFoundHttpException(
            'El usuario solicitado no existe.'
        );
    }

    // Conservar el rol original para impedir cambios por usuarios normales.
    $rolOriginal = $model->role;

    // Conservar el hash de contraseña si el campo queda vacío.
    $passwordOriginal = $model->password_hash;

    if (
        $model->load(Yii::$app->request->post())
        && $model->validate()
    ) {
        if (!$esAdmin) {
            $model->role = $rolOriginal;
        }

        // Si no se escribió una contraseña nueva, conservar el hash actual.
        if (empty($model->password)) {
            $model->password_hash = $passwordOriginal;
        } else {
            $model->setPassword($model->password);
        }

        // Evitar guardar la contraseña en texto plano.
        $model->password = null;

        if ($model->save(false)) {
            Yii::$app->session->setFlash(
                'success',
                'Los datos del usuario se actualizaron correctamente.'
            );

            if ($esAdmin) {
                return $this->redirect(['/user/index']);
            }

            return $this->redirect(['/site/index']);
        }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}


    public function actionChangePassword()
    {
        $user = Yii::$app->user->identity;

        if ($user === null) {
            return $this->redirect(['/site/login']);
        }

        $model = new ChangePasswordForm();

        if (
            $model->load(Yii::$app->request->post())
            && $model->validate()
        ) {
            if (!$user->validatePassword($model->currentPassword)) {
                $model->addError(
                    'currentPassword',
                    'La contraseña actual es incorrecta.'
                );
            } else {
                $user->setPassword($model->newPassword);
                $user->generateAuthKey();

                if ($user->save(false)) {
                    Yii::$app->session->setFlash(
                        'success',
                        'Tu contraseña se actualizó correctamente.'
                    );

                    return $this->redirect(['/site/index']);
                }

                $model->addError(
                    'newPassword',
                    'No se pudo actualizar la contraseña.'
                );
            }
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash(
            'success',
            'El usuario se eliminó correctamente.'
        );

        return $this->redirect(['index']);
    }

    public function actionResetPassword($id)
    {
        $user = $this->findModel($id);

        $newPassword = Yii::$app->security->generateRandomString(12);

        $user->setPassword($newPassword);
        $user->generateAuthKey();

        if ($user->save(false)) {
            Yii::$app->session->setFlash(
                'success',
                'La contraseña temporal es: ' . $newPassword
            );
        } else {
            Yii::$app->session->setFlash(
                'error',
                'No se pudo restablecer la contraseña.'
            );
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id): User
    {
        $model = User::findOne($id);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            'El usuario solicitado no existe.'
        );
    }
}

