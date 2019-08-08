<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemakaian_lab".
 *
 * @property int $id
 * @property string $kode_lab
 * @property string $nama_lab
 * @property string $mata_kuliah
 * @property string $waktu_mulai
 * @property string $waktu_selesai
 * @property string $keterangan
 */
class PemakaianLab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemakaian_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kode_lab', 'nama_lab', 'mata_kuliah', 'date'], 'required'],
            [['id'], 'integer'],
            // [['waktu_mulai', 'waktu_selesai'], 'safe'],
            [['kode_lab'], 'string', 'max' => 4],
            [['nama_lab'], 'string', 'max' => 255],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            // 'id_mhs' => 'id mahasiswa',
            'kode_lab' => 'Kode Laboratorium',
            'nama_lab' => 'Nama Laboratorium',
            'mata_kuliah' => 'Mata Kuliah',
            'date' => 'Tanggal',
            // 'waktu_mulai' => 'Waktu Mulai',
            // 'waktu_selesai' => 'Waktu Selesai',
            // 'keterangan' => 'Keterangan',
        ];
    } 
    public static function getCount()
    {
        return static::find()->count();
    }


}
