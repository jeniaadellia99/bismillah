<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peminjaman".
 *
 * @property int $id
 * @property int $id_barang
 * @property int $id_mhs
 * @property string $keterangan
 */
class Peminjaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'peminjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_barang', 'id_mhs', 'keterangan'], 'required'],
            [['id_barang', 'id_mhs'], 'integer'],
            [['keterangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_barang' => 'Id Barang',
            'id_mhs' => 'Id Mhs',
            'keterangan' => 'Keterangan',
        ];
    }
    public static function getCount()
    {
        return static::find()->count();
    }
}
