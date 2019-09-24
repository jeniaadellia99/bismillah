<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_pinjam".
 *
 * @property int $id_detail_pinjam
 * @property int $id_pinjam
 * @property int $id_inventaris_brg
 */
class DetailPinjam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_pinjam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        [['id_pinjam', 'id_inventaris_brg', 'jumlah'], 'required'],
        [['id_pinjam', 'id_inventaris_brg', 'jumlah', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detail_pinjam' => 'Detail Pinjam',
            'id_pinjam' => 'Pinjam',
            'id_inventaris_brg' => 'Pilih Barang',
            'Jumlah' => 'Jumlah Barang',
            'status' => 'Status',
        ];
    }
    public function getInventarisBrg()
    {
        return $this->hasOne(InventarisBrg::className(), ['id' => 'id_inventaris_brg']);
    }
    public function getPeminjaman()
    {
        return $this->hasOne(Peminjaman::className(), ['id' => 'id_pinjam']);
    }
    public function getPeminjam()
    {
        return $this->hasMany(Peminjaman::className(), ['id' => 'id_pinjam']);
    }
    // public function getNamaPeminjam()
    // {
    //     return Peminjaman::find()->all();
    // }
    public function getNamaBarang()
    {
        return InventarisBrg::find()->all();
    }
    public function getJumlahBrg()
    {
        return InventarisBrg::find()->sum('jumlah_brg');
    }
}
