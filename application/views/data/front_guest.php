<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#table-1").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>

<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Data Pemasangan Sementara</div>
	</div>
	
	<?php if ($count > 0) : ?>
		<table class="table table-bordered table-responsive table-hover datatable" id="table-1">
			<thead>
				<tr>
					<th>#</th>
					<th>No. Registrasi</th>
					<th>Tanggal Daftar</th>
					<th>Nama Pemohon</th>
					<th>Tanggal Pasang</th>
					<th>Tanggal Bongkar</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $no = 1; foreach ($list_data as $data): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data->no_registrasi_pemohon; ?></td>
						<td><?php echo $data->tanggal_daftar; ?></td>
						<td><?php echo $data->nama_pemohon; ?></td>
						<td><?php echo $data->tanggal_pasang; ?></td>
						<td><?php echo $data->jadwal_bongkar; ?></td>
						<td>
							<?php if ($data->status == 1) : ?>
								<div class="label label-success">ON</div>
								<?php if ($data->delta_jam <= 4) : ?>
									<div class="label label-info"><?php echo $data->delta_jam; ?> Jam</div>
								<?php endif; ?>
							<?php else : ?>
								<div class="label label-danger">OFF</div>
							<?php endif; ?>

							<?php
								$tanggal_bongkar = explode(' ', $data->tanggal_bongkar);
								if ('0000-00-00' == $tanggal_bongkar[0]):
							?>
								<br /><br /><div class="label label-warning">DATA BELUM LENGKAP</div>
							<?php endif; ?>
						</td>
						<td>
							<a href="<?php echo base_url() . 'guest/detail/' . $data->id; ?>"><i class="entypo-pencil"></i> Detail</a>
						</td>
					</tr>
				<?php $no++; endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<br />
		<div class="alert alert-warning"><strong>Warning!</strong> Belum ada data pemasangan sementara, sila tambahkan terlebih dahulu.</div>
	<?php endif; ?>
</div>