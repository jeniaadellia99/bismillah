<?php
	use yii\helpers\Html;
	use app\components\Helper;
?>

<table>
	<tr>
		<td style="text-align: center;"><h2>Data Peminjaman</h2></td>
	</tr>
	
</table>

<br>
<table class="table-pdf" style="margin:auto; width:100%;">
	<thead>
		<tr>
			<th><?= strtoupper("No") ?></th>
			<th><?= strtoupper("Nama Peminjam") ?></th>
			<th><?= strtoupper("Tanggal Pinjam") ?></th>
			<th><?= strtoupper("Tanggal Kembali") ?></th>
			<th><?= strtoupper("Status") ?></th>
			<th><?= strtoupper("Keterangan Peminjaman") ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($model as $data) { ?>
		<tr>
			<td><?= $i++ ?></td>
			<?php if ($data->id_dosen_staf==0) { ?>
				<td> <?= $data->mhs->nama ?>
				<?php } ?>
			<?php if ($data->id_mhs==0) { ?>
				<td> <?= $data->dosenStaf->nama ?></td>
				<?php } ?>
			<td><?= $data->tgl_pinjam ?></td>	
			<td><?= $data->tgl_kembali ?></td>
			<?php if ($data->status==1) { ?>
				<td> Menunggu Verifikasi </td>
				<?php } ?>
				<?php if ($data->status==2) { ?>
				<td> Sedang Dipinjam </td>
				<?php } ?>
				<?php if ($data->status==3) { ?>
				<td> Sudah Dikembalikan </td>
				<?php } ?>
			<td><?= $data->keterangan ?></td>
		
		</tr>
		<?php } ?>
	</tbody>
</table>