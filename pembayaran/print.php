<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="../img/volt.png">
	<title>Cetak Struk</title>
	<style>
		* {
			font-family: monospace;
		}
	</style>
	<script type="text/javascript">
		window.print();
	</script>
</head>

<body>
	<?php
	include '../include/config.php';
	$id_byr = $_GET['byr'];
	?>
	<?php
	$sql = mysqli_query($conn, "SELECT * FROM tarif INNER JOIN meter ON tarif.id_tarif=meter.id_tarif INNER JOIN penggunaan ON meter.no_meter=penggunaan.no_meter INNER JOIN tagihan ON penggunaan.id_penggunaan=tagihan.id_penggunaan INNER JOIN pembayaran ON tagihan.id_tagihan=pembayaran.id_tagihan WHERE tagihan.id_tagihan='$id_byr'");
	$row = mysqli_fetch_assoc($sql);
	// var_dump($row);
	// die;
	?>

	<table>
		<tr>
			<td colspan="6" align="center">
				<center><b>STRUK PEMBAYARAN TAGIHAN LISTRIK</b></center>
			</td>
		</tr>
		<br>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="left">NOMOR METER</td>
			<td align="left">:</td>
			<td align="left"><?php echo $row['no_meter']; ?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left">PEMAKAIAN</td>
			<td align="left">:</td>
			<td align="left"><?php echo bulan($row['bulan']) . ' ' . $row['tahun'] ?></td>
		</tr>
		<tr>
			<td align="left">NAMA</td>
			<td align="left">:</td>
			<td align="left"><?php echo $row['pemilik']; ?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left">JUMLAH KWH</td>
			<td align="left">:</td>
			<td align="left"><?php echo $row['jumlah_meter'] ?></td>
		</tr>
		<tr>
			<td align="left">TARIF/DAYA</td>
			<td align="left">:</td>
			<td align="left"><?php echo $row['daya']; ?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left">TANGGAL BAYAR</td>
			<td align="left">:</td>
			<td align="left"><?php echo $row['tanggal_bayar'] ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="6" align="center">
				<center>PLN Menyatakan struk ini sebagai bukti pembayaran yang sah</center>
			</td>
		</tr>
		<tr>
			<td align="left">BIAYA ADMIN</td>
			<td align="left">:</td>
			<td align="left">Rp. <?php echo number_format($row['biaya_admin']) ?></td>
		</tr>
		<tr>
			<td align="left">TOTAL BAYAR</td>
			<td align="left">:</td>
			<td align="left">Rp. <?php echo number_format($row['biaya_tagihan']) ?></td>
		</tr>
		<tr>
			<td colspan="6" align="center">TERIMA KASIH
			<td>
		</tr>
		<tr>
			<td colspan="6" align="center">Rincian Tagihan dapat diakses di www.pln.co.id, Informasi Hubungi Call Center:123</td>
		</tr>
		<tr>
			<td colspan="6" align="center">PPOB PAYMENT ADMIN</td>
		</tr>
	</table>
</body>

</html>