<?php

namespace app\modules\vknew\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\vknew\models\Vknew;

/**
 * VknewSearch represents the model behind the search form about `app\models\Vknew`.
 */
class VknewSearch extends Vknew
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
        $query = Vknew::find();

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
