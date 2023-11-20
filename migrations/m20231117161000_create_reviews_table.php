<?php

declare(strict_types=1);

use yii\db\Migration;

class m20231117161000_create_reviews_table extends Migration
{
    public function up()
    {
        $this->createTable('photos', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'approved' => $this->boolean()->defaultValue(false),
            'rejected' => $this->boolean()->defaultValue(false),
            'imageId' => $this->integer(),
            'width' => $this->integer(),
            'height' => $this->integer(),
        ]);

        // Добавим индекс для ускорения поиска
        $this->createIndex('idx-photos-imageId', 'photos', 'imageId');
    }

    public function down()
    {
        $this->dropTable('photos');
    }
}