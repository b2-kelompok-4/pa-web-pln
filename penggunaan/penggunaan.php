<h2>Penggunaan</h2>
<form action="" method="POST">
	<input type="text" class="form-input mt-2" name="serch" placeholder="Nomor Meter" style="height: 40px; font-size: 20px; display: inline-block" autofocus list="input" autocomplete="off" onchange="submit()">
	<datalist id="input">
		<?php
			$query = mysqli_query($conn, "SELECT * FROM meter");
			while($row = mysqli_fetch_assoc($query)){
		?>
		<option value="<?php echo $row['no_meter'] ?>"><?php echo $row['pemilik'] ?></option>
			<?php } ?>
	</datalist>
	
	<?php if (isset($_POST['serch'])){ 
			$sql = mysqli_query($conn, "SELECT * FROM penggunaan INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan WHERE penggunaan.no_meter='$_POST[serch]' ORDER BY penggunaan.id_penggunaan DESC LIMIT 1");
			$tes = mysqli_fetch_assoc($sql); ?>	
			<a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=addMakhir&meter='.$_POST['serch'] : 'staff.php?page=addMakhir&meter='.$_POST['serch'] ?>" class="btn-xs btn-hijau" style="margin-left: 40px">Tambahkan Penggunaan</a>


        <?php } ?>
</form>
		
	<table class="mt-5">

		<tr>
			<th>No. Meter</th>
			<th>Bulan</th>
			<th>Tahun</th>
			<th>Meter awal</th>
			<th>Meter akhir</th>
			<th>Opsi</th>
		</tr>

		<?php
		if (isset($_POST['serch'])) {
			$query = mysqli_query($conn, "SELECT * FROM meter INNER JOIN tarif ON meter.id_tarif=tarif.id_tarif WHERE no_meter ='$_POST[serch]'");
			if (mysqli_num_rows($query)==0) { ?>
				<script>window.alert('Nomor Meter Tidak Ada')
                window.location = '<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=pelanggan' : 'staff.php?page=pelanggan' ?>';
                </script>;
			<?php }else{
				$query = mysqli_query($conn, "SELECT * FROM penggunaan INNER JOIN tagihan ON penggunaan.id_penggunaan = tagihan.id_penggunaan WHERE no_meter='$_POST[serch]'");
				$pgn = penggunaan_meter($_POST['serch']);
				if (mysqli_num_rows($pgn) == 0) { ?>
					<script>window.alert('Belum Ada Penggunaan, Input Baru')
                    window.location='admin.php?page=addPenggunaan&meter=<?php echo $_POST['serch'] ?>'</script>;
				<?php }
			}	
		
		while ($pggn = mysqli_fetch_assoc($pgn)) {
			?>
			<tr>
				<td><?= $pggn['no_meter']; ?></td>
				<td><?= bulan($pggn['bulan']); ?></td>
				<td><?= $pggn['tahun']; ?></td>
				<td><?= $pggn['meter_awal']; ?></td>
				<td><?= $pggn['meter_akhir']; ?></td>
				<td>
					<?php 
					$test = mysqli_fetch_assoc(select_akhir_meter($pggn['no_meter']));
					if ($pggn['status'] == '1'): ?>
						<a class="blue">Sudah bayar</a>
					<?php elseif($test['id_penggunaan'] == $pggn['id_penggunaan']): ?>
					<a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=editPenggunaan&id='.$pggn['id_penggunaan'].'&meter='.$_POST['serch'].'&bulan='.$pggn['bulan'].'&tahun='.$pggn['tahun'].'&mawal='.$pggn['meter_awal'].'&makhir='.$pggn['meter_akhir'] : 'staff.php?page=editPenggunaan&id='.$pggn['id_penggunaan'].'&meter='.$_POST['serch'].'&bulan='.$pggn['bulan'].'&tahun='.$pggn['tahun'].'&mawal='.$pggn['meter_awal'].'&makhir='.$pggn['meter_akhir'] ?>" class="btn-xs btn-kuning">Ubah Meter Akhir</a>

					<?php else: ?>
					<a class="red">Tidak Bayar</a>
					<?php endif ?>
				</td>
			</tr>
		<?php }} ?>
	</table>