<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php
						switch ($act) {
							case 'tambah':
								echo 'Tambah Data Pegawai';
								break;
							
							default:
								echo 'Perbaharui Data Pegawai';
								break;
						}
					?>
				</div>
			</div>
			
			<div class="panel-body">
				
				<form role="form" class="form-horizontal form-groups-bordered" method="post" action="<?php echo $action; ?>">
	
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Nama Pegawai</label>
						
						<div class="col-sm-5">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" value="<?php echo isset($nama) ? $nama : ''; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="no_hp" class="col-sm-3 control-label">No. Handphone</label>
						
						<div class="col-sm-5">
							<input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. Handphone" value="<?php echo isset($no_hp) ? $no_hp : ''; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default">
								<?php
									switch ($act) {
										case 'tambah':
											echo 'Tambah';
											break;
										
										default:
											echo 'Perbaharui';
											break;
									}
								?>
							</button>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>
</div>
