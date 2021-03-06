<div class="card">
	<div class="card-header">
		Add Kelahiran
	</div>
	<div class="card-body">
		<?= form_open('');?>
		<div class="form-group">
			<label>Nama Balita</label>
			<input type="text" class="form-control " name="nama_balita" value="<?= set_value('nama_balita') ?>"
				autocomplete="off">
			<?= form_error('nama_balita','<small class="text-danger pl-1">','</small>') ?>
		</div>
		<div class="form-group">
			<label>Nomor Akte Kelahiran</label>
			<input type="number" min="0" class="form-control " name="nomor_akte" value="<?= set_value('nomor_akte') ?>">
			<?= form_error('nomor_akte','<small class="text-danger pl-1">','</small>') ?>
		</div>
		<div class="form-group">
			<label>Nomor Kartu Keluarga</label>
			<input type="number" min="0" class="form-control " name="nomor_kk" value="<?= set_value('nomor_kk') ?>">
			<?= form_error('nomor_kk','<small class="text-danger pl-1">','</small>') ?>
		</div>
		<div class="form-group">
			<label>Anak Ke</label>
			<input type="number" min="0" class="form-control " name="anak_ke" value="<?= set_value('anak_ke') ?>">
			<?= form_error('anak_ke','<small class="text-danger pl-1">','</small>') ?>
		</div>
		<div class="form-group">
			<label>Tempat Kelahiran</label>
			<input type="text" class="form-control " name="tempat_lahir" value="<?= set_value('tempat_lahir') ?>"
				autocomplete="off">
			<?= form_error('tempat_lahir','<small class="text-danger pl-1">','</small>') ?>
		</div>
		<div class="form-group">
			<label>Tanggal Lahir</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
				</div>
				<input type="text" name="tanggal_lahir" class="form-control" data-inputmask-alias="datetime"
					data-inputmask-inputformat="dd/mm/yyyy" data-mask>
			</div>
			<?= form_error('tanggal_lahir','<small class="text-danger pl-1">','</small>') ?>
		</div>
		<div class="form-group clearfix">
			<label>Jenis Kelamin</label><br>
			<div class="icheck-primary d-inline">
				<input type="radio" id="pria" name="jenis_kelamin" value="Laki - Laki" checked>
				<label for="pria">Laki - Laki
				</label>
			</div>
			<div class="icheck-primary d-inline">
				<input type="radio" id="wanita" name="jenis_kelamin" value="Perempuan">
				<label for="wanita">Perempuan
				</label>
			</div>
		</div>
		<div class="form-group">
			<label>Agama</label>
			<select class="form-control custom-select" name="agama" value="<?=set_value('agama')?>">
				<option value="">-- Pilih Agama --</option>
				<option>Islam</option>
				<option>Kristen</option>
				<option>Hindu</option>
				<option>Budha</option>
			</select>
			<?= form_error('agama','<small class="text-danger pl-1">','</small>') ?>
		</div>
		<div class="form-group">
			<label>Nama Ibu</label>
			<select class="form-control select2" style="width: 100%;" name="nama_ibu" id="nama_ibu">
				<option value="">-- Pilih Nama Ibu --</option>
				<?php foreach ($ibu as $key):?>
				<option><?= $key->nama_lengkap ?></option>
				<?php endforeach; ?>
			</select>
			<?= form_error('nama_ibu','<small class="text-danger pl-1">','</small>') ?>
		</div>
		<div class="form-group">
			<label>Nama Ayah</label>
			<select class="form-control select2" style="width: 100%;" name="nama_ayah" id="nama_ayah">
				<option value="">-- Pilih Nama Ayah --</option>
				<?php foreach ($ayah as $key):?>
				<option><?= $key->nama_lengkap ?></option>
				<?php endforeach; ?>
			</select>
			<?= form_error('nama_ayah','<small class="text-danger pl-1">','</small>') ?>
		</div>
	</div>
	<div class="card-footer">
		<a href="<?= base_url('kelahiran')?>" class="btn btn-default">Kembali</a>
		<input type="submit" class="btn btn-primary float-right" value="Submit">
		</form>
	</div>
</div>
