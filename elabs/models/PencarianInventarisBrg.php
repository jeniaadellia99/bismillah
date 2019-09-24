<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InventarisBrg;


/**
 * InventarisBrgSearch represents the model behind the search form of `app\models\InventarisBrg`.
 */
class PencarianInventarisBrg extends InventarisBrg
{
    public $pencarian_barang;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_kategori_brg'], 'integer'],
            [['nama_brg', 'kode_brg', 'jumlah_brg', 'foto', 'pencarian_barang'], 'safe'],
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
        $query = InventarisBrg::find();


        // add conditions that should always apply here

        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        // ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                    'pageSize' => 6
                ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'id' => $this->id_kategori_brg,
        // ]);

        $query->andFilterWhere(['like', 'nama_brg', $this->pencarian_barang]);
            // ->andFilterWhere(['like', 'kode_brg', $this->kode_brg])
            // ->andFilterWhere(['like', 'jumlah_brg', $this->jumlah_brg])
            // ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
