<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Categoria;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\User;
use app\models\Noticia;
use \app\models\Comentario;
use yii\data\Pagination;
use yii\db\Expression;
use app\models\Security;

class SiteController extends Controller
{
//    public $layout = "moderno/main";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Noticia::find();

        $pagination = new Pagination([
            'defaultPageSize'   => 2,
            'totalCount'        => $query->count(),
        ]);

        $noticias = $query->orderBy('id desc')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
        
        $categorias = Categoria::find()->all();
        
        return $this->render(
            'index',
            [
                'categorias'    => $categorias,
                'pagination'    => $pagination,
                'noticias'      => $noticias,
            ]
        );
    }
    
    public function actionSidebar()
    {
        $categorias = Categoria::find()->all();
        
        return $this->render(
            'sidebar',
            [
                'categorias'    => $categorias,
            ]
        );
    }

    public function actionSaludo($nombre=null, $apellido=null)
    {
        $apellido = $apellido . 'sss';

        return $this->render(
            'saludo',
            [
                'nombre'    => $nombre,
                'apellido'  => $apellido,
            ]
        );
    }

    public function actionMiMetodo()
    {
        $model = User::find()->all();



        return $this->render(
            'mi-metodo',
                ['model'=> $model]
        );

    }

    public function actionMiTexto($id=null, $id2=null, $id3=null)
    {
        return $this->render(
            'mi-texto',
            [
                'id'    => $id,
                'id2'   => $id2,
                'id3'   => $id3,
            ]
        );
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * usuario: admin
     * clave: admincapa8
     * @return type
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        $this->layout = 'moderno/main';
        return $this->render('about');
    }
    
    public function actionNoticia($slug)
    {
        $categorias = Categoria::find()->all();
        
        $noticia = Noticia::find("seo_slug = :slug", [":slug" => $slug])->one();
        
        $comentario = new Comentario;
        
        if ($comentario->load(Yii::$app->request->post())) {
            
            $comentario->estado         = '0';
            $comentario->noticia_id     = $noticia->id;
            $comentario->fecha          = new Expression("NOW()");
            $comentario->correo         = Security::mcrypt($comentario->correo);
            
            if ($comentario->save()) {
                Yii::$app->session->setFlash('success', 'Gracias por su comentario');
            } else {
                Yii::$app->session->setFlash('error', 'Su comentario no pudo ser registrado');
            }
            
            return $this->redirect(["/noticia/$slug"]);
        }
        
        return $this->render(
            'noticia',
            [
                'comentario'     => $comentario,
                'categorias'    => $categorias,
                'noticia'       => $noticia,
            ]
        );
    }
}
