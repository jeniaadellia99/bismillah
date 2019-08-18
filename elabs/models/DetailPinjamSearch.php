<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetailPinjam;

/**
 * DetailPinjamSearch represents the model behind the search form of `app\models\DetailPinjam`.
 */
class DetailPinjamSearch extends DetailPinjam
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_detail_pinjam', 'id_pinjam', 'id_inventaris_brg','jumlah'], 'integer'],
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
    public function search($params)
    {
        $query = DetailPinjam::find();

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
            'id_detail_pinjam' => $this->id_detail_pinjam,
            'id_pinjam' => $this->id_pinjam,
            'id_inventaris_brg' => $this->id_inventaris_brg,
            'jumlah' => $this->jumlah,
        ]);

        return $dataProvider;
    }
}
