<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PemakaianLab;

/**
 * PemakaianLabSearch represents the model behind the search form of `app\models\PemakaianLab`.
 */
class PemakaianLabSearch extends PemakaianLab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['kode_lab', 'nama_lab', 'mata_kuliah', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function getQuerySearch($params)
    {
        $query = PemakaianLabSearch::find();

        $this->load($params);

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'kode_lab' => $this->kode_lab,
            'nama_lab' => $this->nama_lab,
            'mata_kuliah' => $this->mata_kuliah,
            'date' => $this->date,
        ]);

        return $query;
    }
    public function search($params)
    {
        $query = PemakaianLab::find();

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
        ]);

        $query->andFilterWhere(['like', 'kode_lab', $this->kode_lab])
                ->andFilterWhere(['like', 'nama_lab', $this->nama_lab])
            ->andFilterWhere(['like', 'mata_kuliah', $this->mata_kuliah])
            ->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }

}


