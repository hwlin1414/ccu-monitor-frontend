<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "Users".
 *
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property integer $group_id
 * @property integer $enabled
 * @property integer $verified
 * @property string $registedip
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Contacts[] $contacts
 * @property Hosts[] $hosts
 * @property Logs[] $logs
 * @property Services[] $services
 * @property Groups $group
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'group_id', 'enabled', 'verified', 'registedip'], 'required'],
            [['group_id', 'enabled', 'verified'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 63, 'min' => 5],
            [['password'], 'required', 'when' => function($model){
                return $model->isNewRecord;
            }],
            [['password'], 'string', 'max' => 255, 'min' => 8, 'when' => function($model){
                return $model->isNewRecord || $model->password !== "";
            }],
            [['registedip'], 'string', 'max' => 15],
            [['name'], 'match', 'pattern' => '/^[a-zA-Z0-9._]+$/'],
            [['name'], 'unique'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '帳號',
            'password' => '密碼',
            'group_id' => '群組',
            'enabled' => '啟用',
            'verified' => '審核',
            'registedip' => '註冊IP',
            'created_at' => '註冊日期',
            'updated_at' => '更新日期',
        ];
    }

    public function scenarios()
    {
        return [
            'default' => ['name', 'password', 'group_id', 'enabled', 'verified'],
            'regist' => ['name', 'password'],
            'self' => ['password'],
        ];
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHosts()
    {
        return $this->hasMany(Hosts::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }

/* Implements IdentityInterface */

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['name' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        throw new NotSupportedException();
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function hasPermission($controller, $action)
    {
        return $this->group->hasPermission($controller, $action);
    }
}
