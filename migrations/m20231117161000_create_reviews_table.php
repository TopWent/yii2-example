<?php

declare(strict_types=1);

use yii\db\Migration;

class m20231117161000_create_reviews_table extends Migration
{
    public function up()
    {
        $this->createTable('photos', [
            'id' => $this->primaryKey(),
            'status' => $this->string()->notNull(),
            ],
        );

        // Добавим индекс для ускорения поиска
        $this->createIndex('idx-photos-imageId', 'photos', 'id');
    }

    public function down()
    {
        $this->dropTable('photos');
    }
}