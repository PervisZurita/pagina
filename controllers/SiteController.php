<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * Control de acceso.
     */
    public function behaviors(): array
    {
        return [

            'access' => [
                'class' => AccessControl::class,

                'rules' => [

                    /*
                     * =========================================
                     * PÁGINAS PÚBLICAS
                     * =========================================
                     */
                    [
                        'allow' => true,

                        'actions' => [
                            'login',
                            'register',
                            'error',
                        ],

                        'roles' => ['?'],
                    ],

                    /*
                     * =========================================
                     * USUARIOS AUTENTICADOS
                     * =========================================
                     */
                    [
                        'allow' => true,

                        'roles' => ['@'],
                    ],
                ],

                /*
                 * Visitante no autenticado:
                 * enviarlo al login.
                 */
                'denyCallback' => function ($rule, $action) {

                    return Yii::$app->response->redirect([
                        '/site/login',
                    ]);
                },
            ],

            /*
             * =========================================
             * MÉTODOS HTTP
             * =========================================
             */
            'verbs' => [
                'class' => VerbFilter::class,

                'actions' => [
                    'logout' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Página principal.
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }


    /**
     * Página Nosotros.
     */
    public function actionAbout(): string
    {
        return $this->render('about');
    }


    /**
     * Página Conceptos.
     */
    public function actionConceptos(): string
    {
        return $this->render('conceptos');
    }


    /**
     * Página Servicios.
     */
    public function actionServicios(): string
    {
        return $this->render('servicios');
    }


    /**
     * Página Blog.
     */
    public function actionBlog(): string
    {
        return $this->render('blog');
    }


    /*
     * =====================================================
     * PÁGINAS DEL CÓDIGO DE ÉTICA
     * =====================================================
     */


    /**
     * Principios éticos.
     */
    public function actionPrincipios(): string
    {
        return $this->render('principios');
    }


    /**
     * Integridad científica.
     */
    public function actionIntegridad(): string
    {
        return $this->render('integridad');
    }


    /**
     * Protección de participantes.
     */
    public function actionParticipantes(): string
    {
        return $this->render('participantes');
    }


    /**
     * Buenas prácticas.
     */
    public function actionBuenasPracticas(): string
    {
        return $this->render('buenas-practicas');
    }


    /**
     * Videos sobre ética científica.
     */
    public function actionVideos(): string
    {
        return $this->render('videos');
    }


    /*
     * =====================================================
     * ACCIONES ANTIGUAS
     * =====================================================
     *
     * Se mantienen para evitar romper enlaces existentes
     * en otras partes de tu proyecto.
     */


    /**
     * Página Seguridad.
     */
    public function actionSeguridad(): string
    {
        return $this->render('seguridad');
    }


    /**
     * Página Privacidad.
     */
    public function actionPrivacidad(): string
    {
        return $this->render('privacidad');
    }


    /**
     * Página Ética Tecnológica.
     */
    public function actionEticaTecnologica(): string
    {
        return $this->render('etica-tecnologica');
    }


    /**
     * Página Educación.
     */
    public function actionEducacion(): string
    {
        return $this->render('educacion');
    }


    /**
     * Login.
     */
    public function actionLogin(): Response|string
    {
        /*
         * Si ya está autenticado,
         * regresar al inicio.
         */
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if (
            $model->load(Yii::$app->request->post()) &&
            $model->login()
        ) {
            return $this->goBack();
        }

        /*
         * No conservar la contraseña.
         */
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Cerrar sesión.
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->redirect([
            '/site/login',
        ]);
    }


    /**
     * Registro público.
     */
    public function actionRegister(): Response|string
    {
        /*
         * Si ya inició sesión,
         * volver al inicio.
         */
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            /*
             * =========================================
             * SEGURIDAD
             * =========================================
             *
             * Los registros públicos siempre
             * tendrán el rol "user".
             */
            $model->role = 'user';


            /*
             * =========================================
             * CONTRASEÑA
             * =========================================
             */
            if (!empty($model->password)) {

                $model->password_hash =
                    Yii::$app->security->generatePasswordHash(
                        $model->password
                    );
            }


            /*
             * =========================================
             * AUTH KEY
             * =========================================
             */
            $model->auth_key =
                Yii::$app->security->generateRandomString();


            /*
             * =========================================
             * GUARDAR
             * =========================================
             */
            if ($model->save()) {

                Yii::$app->session->setFlash(
                    'success',
                    'Cuenta creada correctamente. Ahora puedes iniciar sesión.'
                );

                return $this->redirect([
                    '/site/login',
                ]);
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }


    /**
     * Contacto.
     */
    public function actionContact(): string
    {
        $model = new ContactForm();

        if (
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {

            if (
                $model->sendEmail(
                    Yii::$app->params['adminEmail']
                )
            ) {

                Yii::$app->session->setFlash(
                    'contactFormSubmitted'
                );

                return $this->refresh();
            }
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    /**
     * Acciones especiales de Yii.
     */
    public function actions(): array
    {
        return [

            /*
             * Página de errores.
             */
            'error' => [
                'class' => ErrorAction::class,
            ],

            /*
             * CAPTCHA.
             */
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',

                'fixedVerifyCode' => YII_ENV_TEST
                    ? 'testme'
                    : null,
            ],
        ];
    }
}