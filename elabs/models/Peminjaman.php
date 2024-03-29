<?php

namespace app\models;

use Yii;
use app\models\InventarisBrg;

/**
 * This is the model class for table "peminjaman".
 *
 * @property int $id
 * @property int $id_inventaris_brg
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
            [['id_mhs', 'keterangan', 'status', 'tgl_pinjam', 'id_dosen_staf'], 'required'],
            [['id_inventaris_brg', 'status'], 'integer'],
            [['keterangan'], 'string', 'max' => 255],
              [['tgl_pinjam', 'tgl_kembali'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_inventaris_brg' => 'Nama Barang',
            'id_mhs' => 'Nama',
            'id_dosen_staf' => 'Nama',
            'keterangan' => 'Keterangan',
            'tgl_pinjam' => 'Tanggal Pinjam',
            'tgl_kembali' => 'Rencana Tanggal Kembali',
            'status' => 'Status',
            // 'id_detail_pinjam' => 'Detail Pinjam'
        ];
    }


    public static function getCount()
    {
        return static::find()->count();
    }
    // public function getInventarisBrg()
    // {
    //     return $this->hasOne(InventarisBrg::className(), ['id' => 'id_inventaris_brg']);
    // }
    public function getDetailPinjam()
    {
        return $this->hasOne(DetailPinjam::className(), ['id_detail_pinjam' => 'id']);
    }
    public function getDosenStaf()
    {
        return $this->hasOne(DosenStaf::className(), ['id' => 'id_dosen_staf']);
    }
    public function getMhs()
    {
        return $this->hasOne(Mhs::className(), ['id' => 'id_mhs']);
    }
    public static function getCountGrafik()
    {
        $list = [];
        for ($i = 1; $i <= 12; $i++) {
            if (strlen($i) == 1) $i = '0' . $i;
            $count = static::findCountGrafik($i);

            $list [] = (int)@$count->count();

        }

        return $list;
    }
    public static function findCountGrafik($bulan)
    {
        $tahun = date('Y');
        $lastDay = date("t", strtotime($tahun.'_'.$bulan));

        return static::find()->andWhere(['between','tgl_pinjam', "$tahun-$bulan-01", "$tahun-$bulan-$lastDay"]);
    }
    public function getBarang()
    {
            $listCategory   = InventarisBrg::find()->select('id, nama_brg')
                ->where(['id_inventaris_brg' => 'Yes'])
                ->andWhere(['status' => 'active','approved' => 'active'])
                ->all();
            $list   = ArrayHelper::map( $listCategory,'id','nama_brg');

            return $list;
    }
    // public function findAllDetailPinjam()
    // {
    //     return DetailPinjam::find()
    //         ->andWhere(['id_detail_pinjam' => $this->id_detail_pinjam])
    //         ->all();
    // }
    // public function findAllInventarisBrg()
    // {
    //     return InventarisBrg::find()
    //         ->andWhere(['id' => $this->id_inventaris_brg])
    //         ->all();
    // }
    public function findAllDetailPinjam()
    {
        return DetailPinjam::find()
            ->where(['id_pinjam' => $this->id])
            // ->joinWith('inventaris_brg')
            // ->andWhere(['id_inventaris_brg' => $this->id])
            ->orderBy(['id_inventaris_brg' => SORT_ASC])
            ->all();
    }
    //   public function getJumlahBarangPinjam()
    // {
    //     // return DetailPinjam::find()
    //     //     ->andWhere(['id_inventaris_brg' => $this->id])
    //     //     ->count();
    //     return $this->hasOne();
    // }
    public function getInventarisBrg()
    {
        return $this->hasOne(InventarisBrg::className(), ['id' => 'id_inventaris_brg']);
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

    public function getSelisih()
    {
        return $this->getSelisihTanggal($this->tgl_kembali, date('Y-m-d'));
    }
}
