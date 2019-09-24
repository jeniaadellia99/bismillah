<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "pengembalian".
 *
 * @property int $id
 * @property int $id_pinjam
 * @property string $tgl_kembali
 * @property int $kondisi
 */
class Pengembalian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengembalian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pinjam', 'tgl_kembali', 'kondisi'], 'required'],
            [['id_pinjam', 'kondisi'], 'integer'],
            [['tgl_kembali'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pinjam' => 'Peminjam',
            'tgl_kembali' => 'Tanggal Kembali',
            'kondisi' => 'Kondisi',
        ];
    }
    public function getPeminjaman()
    {
       return $this->hasOne(Peminjaman::className(), ['id' => 'id_pinjam']);
    }
    public function getSelisih()
    {
        return $this->getSelisihTanggal($this->peminjaman->tgl_kembali, date('Y-m-d'));
    }
    public static function getSelisihTanggal($tgl_pinjam, $tgl_kembali, $key = 'd')
    {
        $tgl_pinjam  = date_create($tgl_pinjam);
        $tgl_kembali = date_create($tgl_kembali); /*->modify('+1 day');*/ //Tangal sekarang +1 hari
        
        $diff  = date_diff($tgl_pinjam, $tgl_kembali);
        
        switch ($key) {
            case 'y':
                return $diff->format('%a');
                break;
            case 'm':
                return $diff->format('%a');
                break;
            case 'd':
                return $diff->format('%a');
                break;
            default:
                return $diff->format('%a');
                break;
        }
    }
     public function findAllDetailPinjam()
    {
        return DetailPinjam::find()
            ->where(['id_pinjam' => $this->id_pinjam])
            // ->joinWith('inventaris_brg')
            // ->andWhere(['id_inventaris_brg' => $this->id])
            ->orderBy(['id_inventaris_brg' => SORT_ASC])
            ->all();
    }
    public function getInventarisBrg()
    {
        return $this->hasOne(InventarisBrg::className(), ['id' => 'id_inventaris_brg']);
    }

}
