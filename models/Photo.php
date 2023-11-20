<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @param int $id
 * @param int $width
 * @param int $height
 * @param bool $approved
 * @param bool $rejected
 */
class Photo extends ActiveRecord
{
    public int $id;
    public int $width;
    public int $height;
    public bool $approved;
    public bool $rejected;

    public static function tableName(): string
    {
        return 'photos';
    }

    public function rules(): array
    {
        return [
            [['url'], 'required'],
            [['approved', 'rejected'], 'boolean'],
            [['id', 'width', 'height'], 'safe'],
        ];
    }

    public function approve(): bool
    {
        $this->approved = true;
        $this->rejected = false;

        return $this->save(false);
    }

    public function reject(): bool
    {
        $this->rejected = true;
        $this->approved = false;

        return $this->save(false);
    }

    public function undoDecision(): bool
    {
        $this->rejected = false;
        $this->approved = false;

        return $this->save(false);
    }

    public function getImageUrl(): string
    {
        // Такая вставка работает быстрее чем использование всеми любимого printf()
        return "https://picsum.photos/seed/picsum/{$this->width}/{$this->height}.jpg";
    }
}
