<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventaris_brg".
 *
 * @property int $id
 * @property string $kode_brg
 * @property string $nama_brg
 * @property int $id_kategori_brg
 * @property string $jumlah_brg
 * @property string $foto
 */
class InventarisBrg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventaris_brg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_brg', 'id_kategori_brg', 'jumlah_brg', 'kode_brg'], 'required'],
            [['nama_brg', 'jumlah_brg', 'kode_brg'], 'string', 'max' => 255],
            [['foto'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['id_kategori_brg'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_brg' => 'Nama Barang',
            'kode_brg' => 'Kode Barang',
            'id_kategori_brg' => 'Kategori Barang',
            'jumlah_brg' => 'Jumlah Barang',
            'foto' => 'Gambar',
        ];
    }

    public static function getCount()
    {
        return static::find()->count();
    }

     public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'kode_brg');
    }

    public function getKategoriBrg()
    {
        return $this->hasOne(KategoriBrg::className(), ['id' => 'id_kategori_brg']);
    }
}
