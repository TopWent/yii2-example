<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\BadRequestHttpException;

/**
 * @param int $id
 * @param string $status
 */
class Photo extends ActiveRecord
{
    const STATUS_APPROVE = 'approve';
    const STATUS_REJECT = 'reject';

    public int $id;
    public string $status;

    public static function tableName(): string
    {
        return 'photos';
    }

    public function rules(): array
    {
        return [
            [['status'], 'in', 'range' => [static::STATUS_APPROVE, static::STATUS_REJECT]],
            [['id',], 'safe'],
        ];
    }

    public static function getStatus(string $status): string
    {
        switch ($status) {
            case 'approve':
                $status =  static::STATUS_APPROVE;
                break;
            case 'reject':
                $status = static::STATUS_REJECT;
                break;
            default:
                throw new BadRequestHttpException('Wrong status');
        }

        return $status;
    }
}
