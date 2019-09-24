<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori_brg".
 *
 * @property int $id
 * @property int $nama
 */
class KategoriBrg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori_brg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 255],
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
        ];
    }

    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }

    public static function getGrafikList()
    {
        $data = [];
        foreach (static::find()->all() as $kategoriBrg) {
            $data[] = [$kategoriBrg->nama, (int) $kategoriBrg->getManyBarang()->count()];
        }
        return $data;
    }

     public function getManyBarang()
    {
        return $this->hasMany(InventarisBrg::class, ['id_kategori_brg' => 'id']);
    }
    public function getJumlahBarang()
    {
        return InventarisBrg::find()
            ->andWhere(['id_kategori_brg' => $this->id])
            ->count();
    }

}
