<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "GlobalConfig".
 *
 * @property string $key
 * @property string $value
 */
class GlobalConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'GlobalConfig';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['key'], 'string', 'max' => 63],
            [['value'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => '參數',
            'value' => '值',
        ];
    }
}
