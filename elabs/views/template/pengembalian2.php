<?php
    use yii\helpers\Html;
    use app\components\Helper;
?>
<table border="1" align="center" width="100%">
     <tr>
        <td width="25" align="left"><img src="<?php echo Yii::$app->request->baseUrl; ?>/img/polindra.png" width="10%" height="10%"></td>
        <td align="center" style="font-family: Georgia;" colspan="2">
   <?php { ?>
            <p></p>Jurusan <?= $model->id_pinjam ?> <br>
        <?php } ?>
            POLITEKNIK NEGERI INDRAMAYU<br></p>
            <p>Alamat: Jl. Lohbener, Legok, Kec. Lohbener, Kabupaten Indramayu, Jawa Barat 45252</p>
        </td>     
    </tr>
    <tr>
        <td align="center">POLINDRA</td>
        <td align="center">Form Peminjaman dan Pengembalian Barang/Alat</td>
       
        <td>No. </td>
        
    </tr>
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