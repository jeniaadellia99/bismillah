<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen_staf".
 *
 * @property int $id
 * @property int $nidn
 * @property int $nip
 * @property int $nik
 * @property int $nama
 * @property int $jabatan
 */
class DosenStaf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosen_staf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'jabatan', 'nip', 'nidn', 'nik'], 'required'],
            [['nidn', 'nip', 'nik'], 'string', 'max' => 100],
            [['nama', 'jabatan'], 'string', 'max' => 255],
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
            'nidn' => 'NIDN',
            'nip' => 'NIP',
            'nik' => 'NIK',
            'nama' => 'Nama',
            'jabatan' => 'Jabatan',
            'foto' => 'Foto',
        ];
    }

    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
}
