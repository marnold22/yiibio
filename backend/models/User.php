<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Contributions[] $contributions
 * @property Sitedata[] $ds
 * @property Credentials[] $credentials
 * @property Projects[] $ps
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
    * These are all the realtational funcitons
    **/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContributions()
    {
        return $this->hasMany(Contributions::className(), ['UID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDs()
    {
        return $this->hasMany(Sitedata::className(), ['DID' => 'DID'])->viaTable('contributions', ['UID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCredentials()
    {
        return $this->hasMany(Credentials::className(), ['UID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPs()
    {
        return $this->hasMany(Projects::className(), ['PID' => 'PID'])->viaTable('credentials', ['UID' => 'id']);
    }
}
