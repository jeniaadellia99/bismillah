<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mhs".
 *
 * @property int $id
 * @property string $nama
 * @property int $id_jurusan
 * @property string $foto
 * @property int $nim
 */
class Mhs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mhs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama', 'id_jurusan', 'nim'], 'required'],
            [['id', 'id_jurusan', 'nim'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['foto'], 'file', 'extensions'=> 'jpg, gif, png', 'maxSize'=>5218288, 'tooBig'=> 'batas limit upload gambar 5mb'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'id_jurusan' => 'Jurusan',
            'foto' => 'Foto',
            'nim' => 'NIM',
        ];
    }

     public static function getCount()
    {
        return static::find()->count();
    }
}
