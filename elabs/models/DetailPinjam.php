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
            [['id_pinjam', 'id_inventaris_brg'], 'required'],
            [['id_pinjam', 'id_inventaris_brg'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detail_pinjam' => 'Id Detail Pinjam',
            'id_pinjam' => 'Id Pinjam',
            'id_inventaris_brg' => 'Id Inventaris Brg',
        ];
    }

    public function getInventarisBrg()
    {
        return $this->hasOne(InventarisBrg::className(), ['id' => 'id_inventaris_brg']);
    }

}
