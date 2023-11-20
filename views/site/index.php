<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $photo app\models\Photo */

$this->title = 'Random Photo';
?>

<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::img($photo->getImageUrl(), ['id' => 'randomPhoto']) ?>

    <button class="btn btn-danger" onclick="sendDecision('reject')">Reject</button>
    <button class="btn btn-success" onclick="sendDecision('approve')">Approve</button>

    <?php
    $script = <<< JS
        function sendDecision(action) {
            $.ajax({
                url: '/site/ajax',
                type: 'POST',
                data: { action: action },
                dataType: 'json',
                success: function (data) {
                    $('#randomPhoto').attr('src', data.photoUrl).attr('width', data.width).attr('height', data.height);
                },
                error: function () {
                    alert('Error occurred while processing the decision.');
                }
            });
        }
    JS;

    $this->registerJs($script, \yii\web\View::POS_END);
    ?>
</div>
