<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sitedata".
 *
 * @property integer $DID
 * @property integer $PID
 * @property string $Location
 *
 * @property Contributions[] $contributions
 * @property User[] $us
 * @property Projects $p
 */
class SiteData extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sitedata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PID'], 'required'],
            [['PID'], 'integer'],
            [['Location'], 'string', 'max' => 255],
            [['file'], 'file'],
            [['PID'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['PID' => 'PID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DID' => 'Did',
            'PID' => 'Pid',
            'Location' => 'Location',
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
        return $this->hasMany(Contributions::className(), ['DID' => 'DID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUs()
    {
        return $this->hasMany(User::className(), ['id' => 'UID'])->viaTable('contributions', ['DID' => 'DID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(Projects::className(), ['PID' => 'PID']);
    }
}
