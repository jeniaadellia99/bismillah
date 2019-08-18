<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengembalian".
 *
 * @property int $id
 * @property int $id_pinjam
 * @property string $tgl_kembali
 * @property int $kondisi
 */
class Pengembalian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengembalian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pinjam', 'tgl_kembali', 'kondisi'], 'required'],
            [['id_pinjam', 'kondisi'], 'integer'],
            [['tgl_kembali'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pinjam' => 'Id Pinjam',
            'tgl_kembali' => 'Tgl Kembali',
            'kondisi' => 'Kondisi',
        ];
    }
}
