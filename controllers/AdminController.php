<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Photo;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class AdminController extends Controller
{
    // TODO: в идеале использовать управление ролями конечно, а не токен
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => \yii\filters\AccessControl::class,
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index', 'view', 'cancel-decision'],
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//        ];
//    }

    /**
     * @throws ForbiddenHttpException
     * @throws BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (Yii::$app->request->get('token') !== Yii::$app->params['adminToken']) {
            throw new ForbiddenHttpException('Access denied');
        }

        return parent::beforeAction($action);
    }

    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Photo::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('admin/index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
