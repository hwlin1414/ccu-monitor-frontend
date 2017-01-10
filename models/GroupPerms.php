<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "GroupPerms".
 *
 * @property integer $group_id
 * @property string $perm
 *
 * @property Groups $group
 */
class GroupPerms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'GroupPerms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'perm'], 'required'],
            [['group_id'], 'integer'],
            [['perm'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['perm'], 'trim'],
        ];
    }

    public function scenarios()
    {
        return [
            'default' => ['perm'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'perm' => '權限',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }
}
