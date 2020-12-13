<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content p-3">

		<div class="rounded mt-4 p-4 bg-white shadow-lg">
			<h3><?= $title; ?></h3>
		</div>

		<div class="rounded mt-4 p-4 bg-white shadow-lg">

			<form role="form" id="my-form" method="post" enctype="multipart/form-data">
				<?= cekSessionCSRF(); ?>
				<input type="hidden" name="<?= csrfName(); ?>" value="<?= $this->session->csrf_token; ?>">

				<div class="form-group">
					<label for="username">Username <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="username" name="username" autocomplete="off" value="<?= $ubah->username; ?>" required>
					<?= form_error('username'); ?>
				</div>

				<div class="form-group">
					<label for="nama_user">Nama Lengkap <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="nama_user" name="nama_user" autocomplete="off" value="<?= $ubah->nama_user; ?>" required>
					<?= form_error('nama_user'); ?>
				</div>

				<div class="form-group">
					<label for="telpon">Telpon <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="telpon" name="telpon" autocomplete="off" value="<?= $ubah->telpon; ?>" required>
					<?= form_error('telpon'); ?>
				</div>

				<div class="row mb-3">
					<div class="col-md-6">
						<div class="form-group">
							<label for="id_profil">Profil <span class="text-danger">*</span></label>
							<select id="id_profil" class="form-control select2bs4" name="id_profil" required>
								<option value="">-- Pilih Profil --</option>
								<?php foreach ($profil as $p) : ?>
									<option value="<?= $p->id_profil; ?>" <?= $ubah->id_profil == $p->id_profil ? 'selected' : ''; ?>><?= $p->profil; ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error('id_profil'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="aktif">Aktif <span class="text-danger">*</span></label>
							<select id="aktif" class="form-control" name="aktif" required>
								<option value="Yes" <?= $ubah->aktif == 'Yes' ? 'selected' : ''; ?>>Yes</option>
								<option value="No" <?= $ubah->aktif == 'No' ? 'selected' : ''; ?>>No</option>
							</select>
							<?= form_error('aktif'); ?>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="form-group">
						<label for="foto">Foto User <span class="text-danger">(Max Size 500kb)</span></label>
						<div>
							<input type="file" id="real-file" hidden="hidden" name="foto">
							<button type="button" class="btn btn-outline-success" id="custom-button">
								Upload File <i class="fas fa-upload ml-2"></i>
							</button>
							<span id="custom-text" class="text-secondary ml-2">Tidak ada file yang diupload</span>
						</div>
						<?= form_error('foto'); ?>
					</div>

					<div class="form-group">
						<img id="prev" src="<?= base_url('assets/img/'); ?><?= !empty($ubah->foto) ? $ubah->foto : 'noprofil.png'; ?>" height="270">
					</div>

					<input type="hidden" name="foto_lama" value="<?= $ubah->foto; ?>">
					<input type="hidden" name="id_user" value="<?= $ubah->id_user; ?>">
					<input type="hidden" name="token" value="<?= generate($ubah->id_user); ?>">
				</div>

				<a class="mr-2 mt-3 btn btn-warning " href="<?= base_url('user'); ?>" role="button"><i class="fa fa-arrow-left"></i> Batal</a>
				<button class="mt-3 btn btn-primary" type="submit">Ubah <i class="fas fa-paper-plane"></i></button>

			</form>

		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/footer.php'); ?>