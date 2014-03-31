<script type="text/javascript">
	$(function() {
		$('.confirm-delete').on('click', function(e) {
		    e.preventDefault();

		    var id = $(this).data('id'),
		    	name = $(this).data('name');
		    	removeBtn = $('#modal-delete-pegawai').find('.btn-danger');
		    	removeBtn.attr('href', removeBtn.attr('href').replace(/(&|\?)id=\d*/, id));

		    $('#debug-url-pegawai').html('Hapus : <strong>' + name + '</strong>');

		    $('#modal-delete-pegawai').modal('show');
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
		<div class="panel-title">Data Pegawai</div>
		
		<div class="panel-options">
			<a href="<?php echo base_url() . 'dashboard/pegawai/tambah'; ?>"><i class="entypo-plus"></i> Tambah Pegawai</a>
		</div>
	</div>
	
	<?php if ($count > 0) : ?>
		<table class="table table-bordered table-responsive table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nama</th>
					<th>No. Handphone</th>
					<th>Aksi</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $no = 1; foreach ($list_pegawai as $pegawai): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $pegawai->nama; ?></td>
						<td><?php echo $pegawai->no_hp; ?></td>
						<td width="20%">
							<a href="<?php echo base_url() . 'dashboard/pegawai/edit/' . $pegawai->id; ?>"><i class="entypo-pencil"></i> Sunting</a>
							&nbsp;
							<a href="#" data-id="<?php echo $pegawai->id; ?>"  data-name="<?php echo $pegawai->nama; ?>" class="confirm-delete"><i class="entypo-cancel"></i> Hapus</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<br />
		<div class="alert alert-warning"><strong>Warning!</strong> Belum ada data pegawai, sila tambahkan terlebih dahulu.</div>
	<?php endif; ?>
</div>