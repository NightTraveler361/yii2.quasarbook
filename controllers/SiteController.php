<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;
use app\models\Languages;
use app\models\Authors;
use app\models\ArrPosts;
use app\models\Form;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $modelArrPosts = new ArrPosts();

        $arrTitleRu = $modelArrPosts->ArrTitleRu;
        $arrTitleEng = $modelArrPosts->ArrTitleEng;
        $arrTextRu = $modelArrPosts->ArrTextRu;
        $arrTextEng = $modelArrPosts->ArrTextEng;

        $langRowCount = Languages::find()->count();
        $authRowCount = Authors::find()->count();

        for ($i = 0; $i < 0; $i++):

            $modelPosts = new Posts();

            $langRowRand = rand(1, $langRowCount);
            $langRow = Languages::find()->limit(1)->offset($langRowRand-1)->one();
            $language = Languages::find()->where(['id' => $langRowRand])->one()->language;

            $authRowRand = rand(1, $authRowCount);
            $authRow = Authors::find()->limit(1)->offset($authRowRand-1)->one();

            $timestamp = rand( strtotime("01.01.2017"), strtotime("09.09.2017") );
            $dateRand = date("Y.m.d", $timestamp );

            $likes = rand(1, 100);


            if ($language === 'Русский'):
                $arrTitle = $arrTitleRu;
                $arrText = $arrTextRu;
            else:
                $arrTitle = $arrTitleEng;
                $arrText = $arrTextEng;
            endif;

            $arrTitleFinal = [];        
            $wordsCount = rand(4, 6);
            $keysRand = array_rand($arrTitle, $wordsCount);

            for ($j = 0; $j < $wordsCount; $j++):
                array_push($arrTitleFinal, $arrTitle[$keysRand[$j]]);
            endfor;

            $strTitle = implode(" ", $arrTitleFinal);

            $titleFinal = mb_strtoupper(mb_substr($strTitle, 0, 1));
            $titleFinal = $titleFinal.mb_substr($strTitle, 1);

            $textFinal = '';

            for ($l = 0; $l < rand(3, 4); $l++):
                $arrSentence = [];        
                $wordsCount = rand(5, 8);
                $keysRand = array_rand($arrText, $wordsCount);

                for ($k = 0; $k < $wordsCount; $k++):
                    array_push($arrSentence, $arrText[$keysRand[$k]]);
                endfor;

                $strSentence = implode(" ", $arrSentence);

                $sentence = mb_strtoupper(mb_substr($strSentence, 0, 1));
                $sentence = $sentence.mb_substr($strSentence, 1).'. ';
                $textFinal .= $sentence;
            endfor;

            $modelPosts->language_id = $langRow->id;
            $modelPosts->author_id = $authRow->id;
            $modelPosts->date = $dateRand;
            $modelPosts->likes = $likes;
            $modelPosts->title = $titleFinal;
            $modelPosts->text = substr($textFinal, 0, -1);
            $modelPosts->save();

        endfor;

        /* $select = Yii::$app->db->createCommand('SELECT * FROM languages')->queryAll();

        echo '<pre>';
            print_r($select);
        echo '</pre>'; */

        /* $insert = Yii::$app->db->createCommand()->batchInsert('posts', ['language_id', 'author_id'], [
            [1, 7],
            [2, 5],
            [1, 2]
        ]);

        $insert->execute(); */

        return $this->render('index');
    }

    public function actionEntry()
    {
        $model = new Form();

        /* if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...
 
            return $this->render('entry', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('entry', ['model' => $model]);
        } */

        if(Yii::$app->request->isAjax){
            if ($model->load(Yii::$app->request->post())) {
                /* $work = $this->asJson($model); */
                $work = '<tr><td class="checkBox"><input type="checkbox"></td>';
                $work .= '<td>'.$model["work"].'</td>';
                $work .= '</tr>';
                return $work;
            }
            /* return 'Запрос принят!'; */
        }
        return $this->render('entry', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
