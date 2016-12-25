<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "HostContact".
 *
 * @property integer $id
 * @property integer $host_id
 * @property integer $contact_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property Contacts $contact
 * @property Hosts $host
 */
class HostContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'HostContact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['host_id', 'contact_id'], 'required'],
            [['host_id', 'contact_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['contact_id' => 'id']],
            [['host_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hosts::className(), 'targetAttribute' => ['host_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'host_id' => 'Host ID',
            'contact_id' => 'Contact ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contacts::className(), ['id' => 'contact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHost()
    {
        return $this->hasOne(Hosts::className(), ['id' => 'host_id']);
    }
}
