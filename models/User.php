<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public $id;
    public $token;

    public function rules()
    {
        return [
            [['id', 'token'], 'required'],
            [['id'], 'integer'],
            [['token'], 'string', 'max' => 100],
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->token = \Yii::$app->security->generateRandomString();
        }
        return parent::beforeSave($insert);
    }

    public static function findIdentityByToken($token)
    {
        return static::findOne(['token' => $token]);
    }
}
