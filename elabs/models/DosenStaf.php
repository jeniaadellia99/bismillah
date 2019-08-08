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
            [['nama', 'jabatan'], 'required'],
            [['nidn', 'nip', 'nik'], 'string', 'max' => 16],
            [['nama', 'jabatan'], 'string', 'max' => 255],
            // [['nik'],'match', 'pattern' => '/^[0-15-+]\w*$/i','message' => '*NIK terdiri dari 16 digit'],
            // [['agama'], 'string', 'max' => 12],
            // [['telepon'], 'string', 'max' => 13],
            ['nik', 'match', 'pattern' => '/((\+[0-9]{6})|0)[-]?[0-9]{7}/', 'message' => 'NIK diisi maksimal 16 digit'],
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
        ];
    }

    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
}
