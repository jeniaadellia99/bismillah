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
			<th><?= strtoupper("Nama Laboratorium") ?></th>
			<th><?= strtoupper("Mata Kuliah") ?></th>
			<th><?= strtoupper("Tanggal") ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($model as $data) { ?>
		<tr>
			<td><?= $i++ ?></td>
			<td><?= $data->nama_pengguna ?></td>
			<td><?= $data->nama_lab ?></td>
			<td><?= $data->mata_kuliah ?></td>
			<td><?= $data->date ?></td>

		</tr>
		<?php } ?>
	</tbody>
</table>