<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventaris_brg".
 *
 * @property int $id
 * @property string $nama_brg
 * @property string $kategori_brg
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
            [['nama_brg', 'kategori_brg', 'jumlah_brg'], 'required'],
            [['nama_brg', 'kategori_brg', 'jumlah_brg'], 'string', 'max' => 255],
            [['foto'], 'file', 'extensions' => 'png, jpg, jpeg']
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
            'kategori_brg' => 'Kategori Barang',
            'jumlah_brg' => 'Jumlah Barang',
            'foto' => 'Foto',
        ];
    }

    public static function getCount()
    {
        return static::find()->count();
    }
}
