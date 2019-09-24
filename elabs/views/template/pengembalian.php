<?php
    use yii\helpers\Html;
    use app\components\Helper;
?>
<table border="1" align="center" width="100%">
     <tr>
        <td width="25" align="left"><img src="<?php echo Yii::$app->request->baseUrl; ?>/img/polindra.png" width="10%" height="10%"></td>
        <td align="center" style="font-family: Georgia;" colspan="2">
             <?php { ?>
            <p></p>Jurusan <?=$model->mhs->jurusan->nama ?> <br>
            POLITEKNIK NEGERI INDRAMAYU<br></p>
            <p>Alamat: Jl. Lohbener, Legok, Kec. Lohbener, Kabupaten Indramayu, Jawa Barat 45252</p>
        </td>     
    </tr>
    <tr>
        <td align="center">POLINDRA</td>
        <td align="center">Form Peminjaman dan Pengembalian Barang/Alat</td>
       
        <td>No. <?= $model->id ?> </td>
         <?php } ?>
    </tr>
</table>

    </div>
    <div class="box-body">
          <table border="1" align="center"  width="100%">
            <tr>
                <td colspan="2"><h3 class="box-title">Data diri peminjam</h3></td>
            </tr>
        <tr>
            <td>Nama :</td>
                <?php if ($model->id_dosen_staf==0) { ?>
                <td> <?= $model->mhs->nama ?>
                <?php } ?>
            <?php if ($model->id_mhs==0) { ?>
                <td> <?= $model->dosenStaf->nama ?></td>
                <?php } ?>        
        </tr>
        <tr>
            <td>Tanggal Pinjam</td>
            
            <td><?= Helper::getTanggalSingkat($model->tgl_pinjam) ?></td>
        </tr>
         <tr>
            <td>Rencana Tanggal Kembali</td>
           
            <td><?= Helper::getTanggalSingkat($model->tgl_kembali) ?></td>
        </tr>
          <tr>
            <td>Status</td>
           
           <?php if ($model->status==3) { ?>
                <td>Sudah Dikembalikan
                <?php } ?>
                <?php if ($model->status==2) { ?>
                    <td>Sedang Dipinjam</td>    
                    <?php } ?>
        </tr>
         <tr>
            <td>Keterangan Meminjam Untuk</td>
            
            <td><?= $model->keterangan ?></td>
        </tr>
    </tbody>
</table>
<table border="1" width="100%"> 
    <thead>
          <tr>
                <td colspan="6"><h3 class="box-title">Barang yang dipinjam</h3></td>
            </tr>
        <tr>
            <th><?= ("No") ?></th>
            <th><?= ("Kode Barang") ?></th>
            <th><?= ("Nama Barang") ?></th>
            <th><?= ("Stok Barang") ?></th>
            <th><?= ("Jumlah yang dipinjam") ?></th>
            <th><?= ("Status") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $semuaPeminjaman = $model->findAllDetailPinjam(); ?>
        <?php $i=1; foreach($semuaPeminjaman as $data) { ?>
        <tr align="center">
            <td><?= $i++ ?></td>
            <td><?= @$data->inventarisBrg->kode_brg ?></td>
            <td><?= @$data->inventarisBrg->nama_brg ?></td>
            <td><?= @$data->inventarisBrg->jumlah_brg ?></td>
            <td><?= @$data->jumlah ?></td>
             <?php if ($data->status==1) { ?>
                        <td>Belum diverifikasi</td>
                        <?php } else { ?>
                        <td>sedang dipinjam</td>
                        <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <table border="1" width="100%"> 
    <thead>
          <tr>
                <td colspan="6"><h3 class="box-title">Barang yang dikembalikan</h3></td>
            </tr>
</thead>
</table>
