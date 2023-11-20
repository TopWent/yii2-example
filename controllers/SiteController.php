<?php

namespace app\controllers;

use app\models\Photo;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('site/index', $this->getRandomPhoto());
    }

    public function actionAjax()
    {
        $photo = new Photo();
        $photo->id = $this->getRequest()->post('id');
        $photo->status = Photo::getStatus($this->getRequest()->post('status'));
        $photo->save();

        // Вернуть новую картинку
        return Json::encode([
            $this->getRandomPhoto()
        ]);
    }

    private function getRandomPhoto()
    {
        // надо заменить бы на DTO, в угоду скорости разработки - массив
        $newPhotoUrl = Yii::$app->request->get('https://picsum.photos/seed/picsum/600/500');

        return [
            'photo' => $newPhotoUrl,
            'id' => explode('/', $newPhotoUrl)[2],
        ];
    }
}

