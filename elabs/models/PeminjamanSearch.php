<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Peminjaman;
use app\models\User;

/**
 * PeminjamanSearch represents the model behind the search form of `app\models\Peminjaman`.
 */
class PeminjamanSearch extends Peminjaman
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_inventaris_brg', 'id_mhs', 'status'], 'integer'],
            [['keterangan', 'tgl_pinjam', 'tgl_kembali'], 'safe'],
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
         if (Yii::$app->user->identity->id_user_role == 1) {

        $query = Peminjaman::find();

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
            'id_inventaris_brg' => $this->id_inventaris_brg,
            'id_mhs' => $this->id_mhs,
            'id_dosen_staf' => $this->id_dosen_staf,
            'status'=> $this->status,

        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
     if (Yii::$app->user->identity->id_user_role == 2) {
          $query = Peminjaman::find()->andWhere(['id_mhs' => Yii::$app->user->identity->id_mhs]);
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
            'id_inventaris_brg' => $this->id_inventaris_brg,
            'id_mhs' => $this->id_mhs,
            'id_dosen_staf' => $this->id_dosen_staf,
            'status'=> $this->status,

        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
    }
}
