<script type="text/javascript">
	$(function() {
		$('.confirm-delete').on('click', function(e) {
		    e.preventDefault();

		    var id = $(this).data('id'),
		    	name = $(this).data('name');
		    	removeBtn = $('#modal-delete-admin').find('.btn-danger');
		    	removeBtn.attr('href', removeBtn.attr('href').replace(/(&|\?)id=\d*/, id));

		    $('#debug-url-admin').html('Hapus : <strong>' + name + '</strong>');

		    $('#modal-delete-admin').modal('show');
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
		<div class="panel-title">Data Administrator</div>
		
		<div class="panel-options">
			<a href="<?php echo base_url() . 'dashboard/admin/tambah'; ?>"><i class="entypo-plus"></i> Tambah Administrator</a>
		</div>
	</div>
	
	<table class="table table-bordered table-responsive table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Nama</th>
				<th>Username</th>
				<th>Aksi</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $no = 1; foreach ($list_admin as $admin): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $admin->nama; ?></td>
					<td><?php echo $admin->user; ?></td>
					<td width="20%">
						<a href="<?php echo base_url() . 'dashboard/admin/edit/' . $admin->id; ?>"><i class="entypo-pencil"></i> Sunting</a>
						&nbsp;
						<?php if ($this->session->userdata('SESS_ID_USER') != $admin->id): ?>
							<a href="#" data-id="<?php echo $admin->id; ?>"  data-name="<?php echo $admin->nama; ?>" class="confirm-delete"><i class="entypo-cancel"></i> Hapus</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>