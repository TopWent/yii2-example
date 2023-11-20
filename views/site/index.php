<?php
/** @var string $newPhotoUrl */
/** @var string $id */
?>

<!DOCTYPE html>
<html>
<head>
    <title>Картинка</title>
</head>
<body>
<img src="<?= $newPhotoUrl ?>" alt="Картинка" id="<?= $id ?>" class="photo">

<button class="btn btn-danger" onclick="reject()">Reject</button>
<button class="btn btn-success" onclick="approve()">Approve</button>
<!--На скорую руку добавим логику кнопок-->
<script>
    function reject() {
        $.ajax({
            url: '/index.php?r=site/ajax',
            data: {
                id: document.querySelector('.photo').id,
                status: 'reject'
            },
            success: function(data) {
                let img = document.querySelector('.photo');
                img.src = data.photo;
                img.id = data.id
            },
        });
    }

    function approve() {
        $.ajax({
            url: '/index.php?r=site/ajax',
            data: {
                id: <?= $id ?>,
                status: 'approve'
            },
            success: function(data) {
                let img = document.querySelector('.photo');
                img.src = data.photo;
                img.id = data.id
            },
        });
    }
</script>
</body>
</html>