<script type="text/javascript">
	$(function() {
		$('.confirm-delete').on('click', function(e) {
		    e.preventDefault();

		    var id = $(this).data('id'),
		    	name = $(this).data('name');
		    	removeBtn = $('#modal-delete-guest').find('.btn-danger');
		    	removeBtn.attr('href', removeBtn.attr('href').replace(/(&|\?)id=\d*/, id));

		    $('#debug-url-guest').html('Hapus : <strong>' + name + '</strong>');

		    $('#modal-delete-guest').modal('show');
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
		<div class="panel-title">Data Guest</div>
		
		<div class="panel-options">
			<a href="<?php echo base_url() . 'dashboard/guest/tambah'; ?>"><i class="entypo-plus"></i> Tambah Guest</a>
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
			<?php $no = 1; foreach ($list_guest as $guest): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $guest->nama; ?></td>
					<td><?php echo $guest->user; ?></td>
					<td width="20%">
						<a href="<?php echo base_url() . 'dashboard/guest/edit/' . $guest->id; ?>"><i class="entypo-pencil"></i> Sunting</a>
						&nbsp;
						<a href="#" data-id="<?php echo $guest->id; ?>"  data-name="<?php echo $guest->nama; ?>" class="confirm-delete"><i class="entypo-cancel"></i> Hapus</a>
					</td>
				</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
</div>