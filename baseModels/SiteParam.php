<?php

namespace common\modules\siteParam\baseModels;

use Yii;

use common\models\User;

/**
 * This is the model class for table "site_param".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property integer $active
 * @property integer $type
 * @property integer $sort_order
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $creator_id
 * @property integer $updater_id
 *
 * @property User $creator
 * @property User $updater
 */
class SiteParam extends \common\db\MyActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_param';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value', 'create_time', 'creator_id'], 'required'],
            [['active', 'type', 'sort_order', 'create_time', 'update_time', 'creator_id', 'updater_id'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id'], 'except' => 'test'],
            [['updater_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updater_id' => 'id'], 'except' => 'test'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'active' => 'Active',
            'type' => 'Type',
            'sort_order' => 'Sort Order',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'creator_id' => 'Creator ID',
            'updater_id' => 'Updater ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }
}
