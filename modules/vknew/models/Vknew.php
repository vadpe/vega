<?php

namespace app\modules\vknew\models;

use Yii;

/**
 * This is the model class for table "vknew".
 *
 * @property integer $id
 * @property integer $vk_id
 * @property string $create_date
 * @property string $vkgroup_url
 *
 * @property Vkgroup $vkgroupUrl
 */
class Vknew extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vknew';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vk_id'], 'integer'],
            [['create_date'], 'safe'],
            [['vkgroup_url'], 'string', 'max' => 255],
            [['vkgroup_url'], 'exist', 'skipOnError' => true, 'targetClass' => Vkgroup::className(), 'targetAttribute' => ['vkgroup_url' => 'url']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'vk_id'         => 'Идентификатор ВК',
            'create_date'   => 'Дата добавления',
            'vkgroup_url'   => 'Группа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVkgroupUrl()
    {
        return $this->hasOne(Vkgroup::className(), ['url' => 'vkgroup_url']);
    }
}
