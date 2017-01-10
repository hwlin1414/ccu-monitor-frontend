<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Groups".
 *
 * @property integer $id
 * @property string $name
 *
 * @property GroupPerms[] $groupPerms
 * @property Users[] $users
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 63],
            [['name'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '群組名稱',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupPerms()
    {
        return $this->hasMany(GroupPerms::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['group_id' => 'id']);
    }

    public function hasPermission($controller, $action)
    {
        //$cacheKey = ['cache-perm', 'id' => $this->id, 'controller' => $controller, 'action' => $action];
        //$data = Yii::$app->cache->get($cacheKey);

        //if ($data === false || !is_int($data)) {
            # $data is not found in cache, calculate it from scratch
            $data = intval(GroupPerms::find()
            ->where(['group_id' => $this->id, 'perm' => $controller.'/'.$action])
            ->orWhere(['group_id' => $this->id, 'perm' => $controller.'/*'])
            ->orWhere(['group_id' => $this->id, 'perm' => $controller])
            ->orWhere(['group_id' => $this->id, 'perm' => '*'])
            ->count());

            # store $data in cache so that it can be retrieved next time
            //Yii::$app->cache->set($cacheKey, $data, 7200);
        //}
        return $data !== 0;
    }
}
