<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">Laporan Bulanan</div>
			</div>
			
			<div class="panel-body">
				
				<form role="form" class="form-horizontal form-groups-bordered" method="post" action="<?php echo $action; ?>">
	
					<div class="form-group">
						<label for="tahun" class="col-sm-3 control-label">Tahun</label>
						
						<div class="col-sm-5">
							<select name="tahun" class="select2" data-allow-clear="true" data-placeholder="Pilih Tahun" required>
								<option></option>
								<?php for ($i=$min; $i <= $max; $i++): ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php endfor; ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="bulan" class="col-sm-3 control-label">Bulan</label>
						
						<div class="col-sm-5">
							<select name="bulan" class="select2" data-allow-clear="true" data-placeholder="Pilih Bulan" required>
								<option></option>
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default">Cetak</button>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>
</div>
