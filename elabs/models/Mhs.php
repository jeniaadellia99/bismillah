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
 * @property string $nim
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
            [['nama', 'id_jurusan', 'nim'], 'required'],
            [['id_jurusan'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['nim'], 'string', 'max' => 20],
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
    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
    public function getJurusan()
    {
        return $this->hasOne(Jurusan::className(), ['id' => 'id_jurusan']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id_mhs' => 'id']);
    }

     public function getInventarisBrg()
    {
        return $this->hasOne(InventarisBrg::class, ['id_inventaris_brg' => 'id']);
    }

    public function findAllPeminjaman()
    {
        return Peminjaman::find()
            ->andWhere(['id_mhs' => $this->id])
            ->all();
    }
    public function FindAllJurusan()
    {
        return Jurusan::find()
                ->andWhere(['id_jurusan' => 1])
                ->all();
    }
}
