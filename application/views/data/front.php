<script type="text/javascript">
	$(function() {
		$('.confirm-delete').on('click', function(e) {
		    e.preventDefault();

		    var id = $(this).data('id'),
		    	name = $(this).data('name');
		    	removeBtn = $('#modal-delete-data').find('.btn-danger');
		    	removeBtn.attr('href', removeBtn.attr('href').replace(/(&|\?)id=\d*/, id));

		    $('#debug-url-data').html('Hapus : <strong>' + name + '</strong>');

		    $('#modal-delete-data').modal('show');
		});

	});

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
<?php if($this->session->flashdata('message') != ''): ?>
	<div class="row">
		<div class="alert <?php echo $this->session->flashdata('class'); ?>"><strong><?php echo $this->session->flashdata('short'); ?></strong> <?php echo $this->session->flashdata('message'); ?></div>
	</div>
<?php endif; ?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Data Pemasangan Sementara</div>
		
		<div class="panel-options">
			<a href="<?php echo base_url() . 'dashboard/data/tambah'; ?>"><i class="entypo-plus"></i> Tambah Pemasangan Sementara</a>
		</div>
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
							<a href="<?php echo base_url() . 'dashboard/data/edit/' . $data->id; ?>"><i class="entypo-pencil"></i> Sunting</a>
							&nbsp;
							<a href="#" data-id="<?php echo $data->id; ?>"  data-name="<?php echo $data->nama_pemohon; ?>" class="confirm-delete"><i class="entypo-cancel"></i> Hapus</a>
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