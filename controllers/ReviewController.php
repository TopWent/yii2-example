<?php

declare(strict_types=1);

namespace app\controllers;

use yii\web\Controller;
use app\models\Photo;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ReviewController extends Controller
{
    /**
     * @throws ForbiddenHttpException
     */
    public function actionAdmin(string $token): string
    {
        // TODO: !\Yii::$app->user->isGuest && \Yii::$app->user->identity->token === \Yii::$app->params['adminToken']
        if ($token !== 'xyz123') {
            throw new ForbiddenHttpException('Access denied.');
        }

        return $this->render('review/admin', [
            'photos' => Photo::find()->all(),
        ]);
    }

    /**
     * @param string $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionUndoDecision(int $id): Response
    {
        $photo = $this->findPhoto($id);
        $photo->undoDecision();

        return $this->redirect(['review/admin', 'token' => 'xyz123']);
    }

    /**
     * @param $id
     * @return Photo|null
     * @throws NotFoundHttpException
     */
    protected function findPhoto(int $id): ?Photo
    {
        if (($photo = Photo::findOne($id)) !== null) {
            return $photo;
        } else {
            throw new NotFoundHttpException('The requested photo does not exist.');
        }
    }
}