<?php

namespace app\controllers;

use app\models\Photo;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    private Photo $photoModel;

    public function __construct($id, $module, Photo $photoModel, $config = [])
    {
        $this->photoModel = $photoModel;
        parent::__construct($id, $module, $config);
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
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->renderAjax('index', [
            'photo' => $this->view->params['randomPhoto'],
        ]);
    }

    /**
     * @return array
     */
    public function actionAjax(): array
    {
        $action = $this->request->post('action');
        $photo = $this->view->params['randomPhoto'];

        if ($action === 'approve') {
            $photo->approve();
        } elseif ($action === 'reject') {
            $photo->reject();
        }

        $photo = $this->photoModel
            ->find()
            ->where(['approved' => false, 'rejected' => false])
            ->orderBy('RAND()')
            ->one();

        return [
            'photoUrl' => $photo->getImageUrl(),
            'imageId' => $photo->id,
            'width' => $photo->width,
            'height' => $photo->height,
        ];
    }

    public function beforeAction($action)
    {
        $this->view->params['randomPhoto'] = $this->photoModel
            ->find()
            ->where(['approved' => false, 'rejected' => false])
            ->orderBy('RAND()')
            ->one();

        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        if ($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $result;
        }

        return parent::afterAction($action, $result);
    }
}
