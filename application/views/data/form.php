<script type="text/javascript">
	$(function() {
		function ganti_jadwal_bongkar () {
			var tanggal_pasang		= $('#tanggal_pasang').val();
			var tanggal 			= tanggal_pasang.split('-');

			var jam_pasang 			= $('#jam_pasang').val();
			var jam 				= jam_pasang.split(':');

			var lama_pesta 			= $('#lama_pesta').val();

			var tanggal_pasang_baru	= new Date(tanggal[0], tanggal[1], tanggal[2], jam[0], jam[1]);
			var date 				= new Date(tanggal_pasang_baru.getTime());

			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>dashboard/get_date/" + lama_pesta + "/" + jam[1] + "/" + jam[0] + "/" + tanggal[2] + "/" + tanggal[1] + "/" + tanggal[0],
				data: "",
				success: function(response){
					$('#jadwal_bongkar').val(response);
				}
			})
		}

		function ganti_delta_jam () {
			//dapatkan tanggal bongkar seharusnya
			var jadwal_bongkar 		= $('#jadwal_bongkar').val();
			var tanggal_bongkar		= $('#tanggal_bongkar').val();
			
			if (jadwal_bongkar != 0 && tanggal_bongkar != 0) {
				var bongkar 			= jadwal_bongkar.split(' ');

				var jadwal_bongkar 		= bongkar[0];
				var jam_jadwal_bongkar 	= bongkar[1];

				var tanggal 			= jadwal_bongkar.split('-');
				var jam 		 		= jam_jadwal_bongkar.split(':');

				var jadwal_bongkar		= new Date(tanggal[0], tanggal[1], tanggal[2], jam[0], jam[1]);

				//dapatkan tanggal bongkar sebenarnya
				var tanggal_bongkar 	= tanggal_bongkar.split('-');

				var jam_bongkar			= $('#jam_bongkar').val();
				var jam_bongkar 	 	= jam_bongkar.split(':');

				var tanggal_bongkar		= new Date(tanggal_bongkar[0], tanggal_bongkar[1], tanggal_bongkar[2], jam_bongkar[0], jam_bongkar[1]);

				// Convert both dates to milliseconds
				var date1_ms = jadwal_bongkar.getTime();
				var date2_ms = tanggal_bongkar.getTime();

				// Calculate the difference in milliseconds
				var difference_ms = date2_ms - date1_ms;

				// Convert back to days and return
				$('#delta_jam').val(Math.round(difference_ms/(1000*60*60)));
			};
		}

		$('.dinamis').on('change', function(e) {
			ganti_jadwal_bongkar();
			ganti_delta_jam();
		});

		$('input:radio[name="jenis"]').on('change', function (e) {
			if ('1' == $(this).val()) {
				$('#id_pelanggan_wrapper').show();
				$('#daya_pelanggan_wrapper').show();
			} else {
				$('#id_pelanggan_wrapper').hide();
				$('#daya_pelanggan_wrapper').hide();
			}
		})
	});
</script>
<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php
						switch ($act) {
							case 'tambah':
								echo 'Tambah Data Pemasangan Sementara';
								break;
							
							default:
								echo 'Perbaharui Data Pemasangan Sementara';
								break;
						}
					?>
				</div>
			</div>
			
			<div class="panel-body">
				
				<form role="form" class="form-horizontal form-groups-bordered" method="post" action="<?php echo $action; ?>">
	
					<div class="form-group">
						<label for="tanggal_daftar" class="col-sm-3 control-label">Tanggal Daftar</label>
						
						<div class="col-sm-5">
							<input type="text" name="tanggal_daftar" class="form-control datepicker" data-format="yyyy-mm-dd" data-start-view="2" placeholder="Tanggal Daftar" value="<?php echo isset($tanggal_daftar) ? $tanggal_daftar : ''; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Nama</label>
						
						<div class="col-sm-5">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo isset($nama_pemohon) ? $nama_pemohon : ''; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="jenis" class="col-sm-3 control-label">Jenis</label>
						
						<div class="col-sm-5">
							<?php if (isset($jenis_pemohon) && ($jenis_pemohon==1)): ?>
								<div class="radio">
									<label>
										<input type="radio" name="jenis" id="jenis" value="1" checked>Pelanggan
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="jenis" id="jenis" value="2" >Non-Pelanggan
									</label>
								</div>
							<?php else: ?>
								<div class="radio">
									<label>
										<input type="radio" name="jenis" id="jenis" value="1" >Pelanggan
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="jenis" id="jenis" value="2" checked>Non-Pelanggan
									</label>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group" id="id_pelanggan_wrapper" <?php echo (isset($jenis_pemohon) && (1 == $jenis_pemohon)) ? '' : 'style="display: none;"';?>>
						<label for="id_pelanggan" class="col-sm-3 control-label">ID Pelanggan</label>
						
						<div class="col-sm-5">
							<input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" placeholder="ID Pelanggan" value="<?php echo isset($id_pelanggan_pemohon) ? $id_pelanggan_pemohon : ''; ?>">
						</div>
					</div>

					<div class="form-group" id="daya_pelanggan_wrapper" <?php echo (isset($jenis_pemohon) && (1 == $jenis_pemohon)) ? '' : 'style="display: none;"';?>>
						<label for="daya" class="col-sm-3 control-label">Daya</label>
						
						<div class="col-sm-5">
							<input type="text" class="form-control" id="daya" name="daya" placeholder="Daya" value="<?php echo isset($daya_pemohon) ? $daya_pemohon : ''; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="no_registrasi" class="col-sm-3 control-label">No. Registrasi</label>
						
						<div class="col-sm-5">
							<input type="text" class="form-control" id="no_registrasi" name="no_registrasi" placeholder="No. Registrasi" value="<?php echo isset($no_registrasi_pemohon) ? $no_registrasi_pemohon : ''; ?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="no_hp" class="col-sm-3 control-label">Alamat</label>
						
						<div class="col-sm-5">
							<textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="5" required><?php echo isset($alamat_pemohon) ? $alamat_pemohon : ''; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="daya_pesta" class="col-sm-3 control-label">Daya Pemasangan Sementara</label>
						
						<div class="col-sm-5">
							<input type="text" class="form-control" id="daya_pesta" name="daya_pesta" placeholder="Daya Pemasangan Sementara" value="<?php echo isset($daya_pesta) ? $daya_pesta : ''; ?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="lama_pesta" class="col-sm-3 control-label">Lama Pemasangan Sementara</label>
						
						<div class="col-sm-5">
							<div class="input-group">
								<input type="text" class="form-control dinamis" id="lama_pesta" name="lama_pesta" placeholder="Lama Pemasangan Sementara" value="<?php echo isset($lama_pesta) ? $lama_pesta : '0'; ?>" required>
								
								<div class="input-group-addon">
									<a href="#">Jam</a>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="tanggal_pasang" class="col-sm-3 control-label">Tanggal Pasang</label>

						<div class="col-sm-5">
							<div class="date-and-time">
								<input type="text" name="tanggal_pasang" id="tanggal_pasang" class="form-control datepicker dinamis" data-format="yyyy-mm-dd" data-start-view="2" placeholder="Tanggal Pasang" value="<?php echo isset($tanggal_pasang) ? $tanggal_pasang : ''; ?>" required>
								<input type="text" name="jam_pasang" id="jam_pasang" class="form-control timepicker dinamis" data-template="dropdown" data-show-seconds="false" data-show-meridian="false"  data-minute-step="5" data-second-step="5" placeholder="Jam Pasang" value="<?php echo isset($jam_pasang) ? $jam_pasang : ''; ?>" required />
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="petugas_pasang" class="col-sm-3 control-label">Petugas Pasang</label>
						
						<div class="col-sm-5">
							<select name="petugas_pasang" class="select2" data-allow-clear="true" data-placeholder="Pilih Petugas" required>
								<option></option>
								<?php foreach($list_pegawai as $pegawai): ?>
									<?php if (isset($id_petugas_pasang)): ?>
										<?php if ($id_petugas_pasang == $pegawai->id): ?>
											<option value="<?php echo $pegawai->id; ?>" selected="selected"><?php echo $pegawai->nama; ?></option>	
										<?php else: ?>
											<option value="<?php echo $pegawai->id; ?>"><?php echo $pegawai->nama; ?></option>
										<?php endif ?>
									<?php else: ?>
										<option value="<?php echo $pegawai->id; ?>"><?php echo $pegawai->nama; ?></option>
									<?php endif ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="jadwal_bongkar" class="col-sm-3 control-label">Jadwal Bongkar</label>
						
						<div class="col-sm-5">
							<input type="text" class="form-control" name="jadwal_bongkar" id="jadwal_bongkar" value="<?php echo isset($jadwal_bongkar) ? $jadwal_bongkar : '0'; ?>" disabled/>
						</div>
					</div>

					<div class="form-group">
						<label for="status" class="col-sm-3 control-label">Status</label>
						
						<div class="col-sm-5">
							<div class="make-switch">
								<?php 
									$checked = (isset($status) && ($status==1)) ? 'checked' : '';
								?>
							    <input type="checkbox" name="status" <?php echo $checked; ?>>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="tanggal_bongkar" class="col-sm-3 control-label">Tanggal Bongkar</label>
						
						<div class="col-sm-5">
							<div class="date-and-time">
								<input type="text" name="tanggal_bongkar" id="tanggal_bongkar" class="form-control datepicker dinamis" data-format="yyyy-mm-dd" data-start-view="2" value="<?php echo isset($tanggal_bongkar) ? $tanggal_bongkar : ''; ?>" placeholder="Tanggal Bongkar">
								<input type="text" name="jam_bongkar" id="jam_bongkar" class="form-control timepicker dinamis" data-template="dropdown" data-show-seconds="false" data-show-meridian="false"  data-minute-step="5" data-second-step="5" value="<?php echo isset($jam_bongkar) ? $jam_bongkar : ''; ?>" placeholder="Jam Bongkar" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="petugas_bongkar" class="col-sm-3 control-label">Petugas Bongkar</label>
						
						<div class="col-sm-5">
							<select name="petugas_bongkar" class="select2" data-allow-clear="true" data-placeholder="Pilih Petugas">
								<option></option>
								<?php foreach($list_pegawai as $pegawai): ?>
									<?php if (isset($id_petugas_pasang)): ?>
										<?php if ($id_petugas_pasang == $pegawai->id): ?>
											<option value="<?php echo $pegawai->id; ?>" selected="selected"><?php echo $pegawai->nama; ?></option>	
										<?php else: ?>
											<option value="<?php echo $pegawai->id; ?>"><?php echo $pegawai->nama; ?></option>
										<?php endif ?>
									<?php else: ?>
										<option value="<?php echo $pegawai->id; ?>"><?php echo $pegawai->nama; ?></option>
									<?php endif ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="delta_jam" class="col-sm-3 control-label">Delta Jam</label>
							
						<div class="col-sm-5">
							<div class="input-group">
								<input type="text" class="form-control dinamis" id="delta_jam" name="delta_jam" placeholder="Tentukan tangal pasang dan tanggal bongkar terlebih dahulu" value="<?php echo isset($delta_jam) ? $delta_jam : ''; ?>" disabled>
								
								<div class="input-group-addon">
									<a href="#">Jam</a>
								</div>
							</div>
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

							<?php if ($act == 'edit') : ?>
								&nbsp;&nbsp;<a href="<?php echo $act_cetak; ?>" class="btn btn-default">Cetak</a>	
							<?php endif; ?>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>
</div>
