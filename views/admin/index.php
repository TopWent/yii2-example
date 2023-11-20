<?php

use app\models\Photo;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Page';
?>

<div class="admin-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->id, ['admin/view', 'id' => $model->id]);
                },
            ],
            [
                'attribute' => 'imageUrl',
                'format' => ['image', ['width' => '100', 'height' => '100']],
                'value' => function ($model) {
                    return "https://picsum.photos/id/{$model->id}/200/300";
                },
            ],
            [
                'attribute' => 'imageUrl',
                'format' => ['image', ['width' => '100', 'height' => '100']],
                'value' => function ($model) {
                    return $model->imageUrl;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status === Photo::STATUS_APPROVE ? 'Approved' : 'Rejected';
                },
            ],
        ],
    ]); ?>
</div>
