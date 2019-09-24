<?php
	use yii\helpers\Html;
	use app\components\Helper;
?>

<table>
	<tr>
		<td style="text-align: center;"><h2>Data Pemakaian Laboratorium</h2></td>
	</tr>
	
</table>

<br>
<table class="table-pdf" style="margin:auto; width:100%;">
	<thead>
		<tr>
			<th><?= strtoupper("No") ?></th>
			<th><?= strtoupper("Nama Pengguna") ?></th>
			<th><?= strtoupper("Nomor Komputer") ?></th>
			<th><?= strtoupper("Nama Laboratorium") ?></th>
			<th><?= strtoupper("Mata Kuliah") ?></th>
			<th><?= strtoupper("Waktu Masuk") ?></th>
			<th><?= strtoupper("Waktu Keluar") ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($model as $data) { ?>
		<tr>
			<td><?= $i++ ?></td>
			<td><?= $data->nama_pengguna ?></td>
			<td><?= $data->no_komputer ?></td>
			<td><?= @$data->lab->nama ?></td>
			<td><?= $data->mata_kuliah ?></td>
			<td><?= $data->date ?></td>
			<td><?= $data->tgl_keluar ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>