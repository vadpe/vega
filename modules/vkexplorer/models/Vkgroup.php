<?php

namespace app\modules\vkexplorer\models;

use Yii;
use app\modules\vkexplorer\models\Vkmember;
use app\modules\vkexplorer\models\Vknew;

/**
 * This is the model class for table "vkgroup".
 *
 * @property integer $id
 * @property string $url
 * @property string $description
 *
 * @property Vkmember[] $vkmembers
 * @property Vknew[] $vknews
 */
class Vkgroup extends \yii\db\ActiveRecord
{
    public $started = 0;
    
    public function getMembers1() {
        
        $version = '5.52';
        $page = 0;
        $limit = 1000;
        
        $parts = explode('/', $this->url);
        $name = '';
        
        $cnt = count($parts);
        if ($cnt) {
            $name = $parts[$cnt-1];
        }
        
        $users = array();
        
        do {
            $offset = $page * $limit;
            
            $answer =  json_decode(file_get_contents(
                'https://api.vk.com/method/groups.getMembers' . 
                '?group_id=' . $name . 
                '&v=' . $version . 
                '&offset=' . $offset . 
                '&count=' . $limit
                ), true);
            
            if (!array_key_exists('response', $answer)) {
                break;
            }
            
            foreach($answer['response']['items'] as $user ) {
                $users[$user] = 
                [
                    'id'            => 0, 
                    'vk_id'         => $user, 
                    'create_date'   => date('Y-m-d H:i:s'), 
                    'vkgroup_url'   => $this->url
                ];
            }
            
            $page++;
            usleep(400000);
        }
        while($answer['response']['count'] > $offset + $limit );
        
        
        // Извлекаем из Vkmember все записи с данной группой 
        // (сохраняем в массив)
        $currecs = Vkmember::find()
                ->select('vk_id')
                ->where(['vkgroup_url' => $this->url])
                ->asArray()
                ->all();
        
        // Удаляем из Vkmember все записи с данной группой
        Vkmember::deleteAll(['vkgroup_url' => $this->url]);
        
        
        // Переформатирование массива извлеченных записей
        $curitems = array();
        foreach ($currecs as $rec) {
            $curitems[$rec['vk_id']] = $rec;
        }
        
        // Поиск и сохранение всех новых записей среди полученных по отношению к извлеченным из Vkmember
        $newitems = array_diff(array_keys($users), array_keys($curitems));
            
        $newusers = array();
        foreach ($newitems as $newitem) {
            $newusers[] = $users[$newitem];
        }
        
        // Вставка в Vkmember всех полученных записей взамен удаленных
        if (count($users)) {
            Yii::$app->db
                    ->createCommand()
                    ->batchInsert(Vkmember::tableName(), array_keys(Vkmember::attributeLabels()), $users)
                    ->execute();
        }
        
        
        // Удаляем из Vknew все записи с данной группой
        Vknew::deleteAll(['vkgroup_url' => $this->url]);
        
        // Вставка в Vknew всех новых записей среди полученных по отношению к извлеченным из Vkmember
        if (count($newusers)) {
            Yii::$app->db
                    ->createCommand()
                    ->batchInsert(Vknew::tableName(), array_keys(Vknew::attributeLabels()), $newusers)
                    ->execute();
        }
    }
    
    /**
     * @inheritdoc
     */
    public function getMembers($started) {
        $version = '5.52';
        $page = 0;
        $limit = 1000;
        
        $parts = explode('/', $this->url);
        $name = '';
        
        $cnt = count($parts);
        if ($cnt) {
            $name = $parts[$cnt-1];
        }
        
        $currecs = Vkmember::find()
                ->select('vk_id')
                ->where(['vkgroup_url' => $this->url])
                ->asArray()
                ->all();
        
        $newInDb = Vknew::find()->count();
        if ($started && $newInDb) {
            Vknew::deleteAll();
        }
        
        $curitems = array();
        foreach ($currecs as $rec) {
            $curitems[$rec['vk_id']] = $rec;
        }
        
        do {
            $offset = $page * $limit;
            
            $answer =  json_decode(file_get_contents(
                'https://api.vk.com/method/groups.getMembers' . 
                '?group_id=' . $name . 
                '&v=' . $version . 
                '&offset=' . $offset . 
                '&count=' . $limit
                ), true);

            if (!array_key_exists('response', $answer)) {
                break;
            }
            
            $users = array();
            foreach($answer['response']['items'] as $user ) {
                $users[$user] = 
                [
                    'id'            => 0, 
                    'vk_id'         => $user, 
                    'create_date'   => date('Y-m-d H:i:s'), 
                    'vkgroup_url'   => $this->url
                ];
            }
            
            $newitems = array_diff(array_keys($users), array_keys($curitems));
            
            $newusers = array();
            foreach ($newitems as $newitem) {
                $newusers[] = $users[$newitem];
            }
            
            if (count($newusers)) {
                
                Yii::$app->db
                    ->createCommand()
                    ->batchInsert(Vkmember::tableName(), array_keys(Vkmember::attributeLabels()), $newusers)
                    ->execute();
                
                //if ($page === 0) {
                //    Vknew::deleteAll();
                //}
                
                Yii::$app->db
                    ->createCommand()
                    ->batchInsert(Vknew::tableName(), array_keys(Vknew::attributeLabels()), $newusers)
                    ->execute();
            }
            
            
            $page++;
            usleep(400000);
            
        }
        while($answer['response']['count'] > $offset + $limit );
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vkgroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'url'               => 'Ссылка',
            'description'       => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVkmembers()
    {
        return $this->hasMany(Vkmember::className(), ['vkgroup_url' => 'url']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVknews()
    {
        return $this->hasMany(Vknew::className(), ['vkgroup_url' => 'url']);
    }
}
