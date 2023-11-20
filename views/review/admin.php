<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $photos app\models\Photo[] */

$this->title = 'Admin Page';
?>

<div class="admin-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Decision</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($photos as $photo): ?>
            <tr>
                <td><?= $photo->id ?></td>
                <td><?= Html::img($photo->getImageUrl(), ['width' => $photo->width, 'height' => $photo->height]) ?></td>
                <td><?= $photo->approved ? 'Approved' : ($photo->rejected ? 'Rejected' : 'Pending') ?></td>
                <td>
                    <?= Html::a('Undo Decision', ['admin/undo-decision', 'id' => $photo->id], [
                        'data' => [
                            'confirm' => 'Are you sure you want to undo this decision?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
