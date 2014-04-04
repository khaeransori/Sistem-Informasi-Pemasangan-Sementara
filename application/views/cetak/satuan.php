<<html>
<head>
	<title>
		<?php echo $title; ?>
	</title>
</head>
<body>
	<?php
	$jenis 		= ($data->jenis_pemohon == 1) ? 'Pelanggan' : 'Non-Pelanggan';
	$status 	= (1 == $data->status) ? 'ON' : 'OFF';
	$bongkar 	= explode(' ', $data->tanggal_bongkar);
	?>
	<table width="100%">
		<tr>
			<td width="25%"><img height="75px" src="<?php echo base_url();?>assets/images/logo.png" /></td>
			<td width="75%" align="center">
				<h1>Data Pelanggan Pemasangan Sementara</h1>
			</td>
		</tr>
	</table>

	<hr />
	<table>
		<tr>
			<td>Tanggal Daftar</td>
			<td>:</td>
			<td><?php echo $data->tanggal_daftar; ?></td>
		</tr>

		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?php echo $data->nama_pemohon; ?></td>
		</tr>

		<tr>
			<td>Jenis</td>
			<td>:</td>
			<td><?php echo $jenis; ?></td>
		</tr>

		<?php if (1 == $data->jenis_pemohon) : ?>
			<tr>
				<td>ID Pelanggan</td>
				<td>:</td>
				<td><?php echo $data->id_pelanggan_pemohon; ?></td>
			</tr>

			<tr>
				<td>Daya</td>
				<td>:</td>
				<td><?php echo $data->daya_pemohon; ?></td>
			</tr>
		<?php endif; ?>

		<tr>
			<td>No. Registrasi</td>
			<td>:</td>
			<td><?php echo $data->no_registrasi_pemohon; ?></td>
		</tr>

		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $data->alamat_pemohon; ?></td>
		</tr>

		<tr>
			<td>Daya Pemasangan Sementara</td>
			<td>:</td>
			<td><?php echo $data->daya_pesta; ?></td>
		</tr>

		<tr>
			<td>Lama Pemasangan Sementara</td>
			<td>:</td>
			<td><?php echo $data->lama_pesta . ' Jam'; ?></td>
		</tr>

		<tr>
			<td>Tanggal Pasang</td>
			<td>:</td>
			<td><?php echo $data->tanggal_pasang; ?></td>
		</tr>

		<tr>
			<td>Petugas Pasang</td>
			<td>:</td>
			<td><?php echo $data->nama_pegawai_pasang; ?></td>
		</tr>

		<tr>
			<td>Jadwal Bongkar</td>
			<td>:</td>
			<td><?php echo $data->jadwal_bongkar; ?></td>
		</tr>

		<tr>
			<td>Status</td>
			<td>:</td>
			<td><?php echo $status; ?></td>
		</tr>

		<tr>
			<td>Tanggal Bongkar</td>
			<td>:</td>
			<td>
				<?php
					if ('0000-00-00' == $bongkar[0]) {
						echo 'Belum dilakukan pembongkaran';
					} else {
						echo $data->tanggal_bongkar;
					}
				?>
		</tr>

		<tr>
			<td>Petugas Bongkar</td>
			<td>:</td>
			<td>
				<?php
					if ('0000-00-00' == $bongkar[0]) {
						echo 'Belum dilakukan pembongkaran';
					} else {
						echo $data->nama_pegawai_bongkar;
					}
				?>
			</td>
		</tr>

		<tr>
			<td>Delta Jam</td>
			<td>:</td>
			<td>
				<?php
					if(NULL == $data->delta_jam) {
						echo '0 Jam';
					} else {
						echo $data->delta_jam . ' Jam';
					}
				?>
			</td>
		</tr>
	</table>
</body>
</html>