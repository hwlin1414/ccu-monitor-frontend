<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Contacts".
 *
 * @property integer $id
 * @property string $addr
 * @property integer $user_id
 * @property string $verified
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property Users $user
 * @property HostContact[] $hostContacts
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['addr', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['addr'], 'string', 'max' => 63],
            [['verified'], 'string', 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'addr' => 'Addr',
            'user_id' => 'User ID',
            'verified' => 'Verified',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHostContacts()
    {
        return $this->hasMany(HostContact::className(), ['contact_id' => 'id']);
    }
}
