<?php

namespace app\modules\vkexplorer\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\vkexplorer\models\Vkmember;

/**
 * VkmemberSearch represents the model behind the search form about `app\models\Vkmember`.
 */
class VkmemberSearch extends Vkmember
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vk_id'], 'integer'],
            [['create_date', 'vkgroup_url'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Vkmember::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'vk_id' => $this->vk_id,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'vkgroup_url', $this->vkgroup_url]);

        return $dataProvider;
    }
}
