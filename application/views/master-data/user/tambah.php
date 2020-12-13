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
					<input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
					<?= form_error('username'); ?>
				</div>

				<div class="form-group">
					<label for="password">Password <span class="text-danger">*</span></label>
					<input type="password" class="form-control" id="password" name="password" autocomplete="off" required minlength="8">
					<?= form_error('password'); ?>
				</div>

				<div class="form-group">
					<label for="passconfirm">Konfimasi Password <span class="text-danger">*</span></label>
					<input type="password" class="form-control" id="passconfirm" name="passconfirm" autocomplete="off" required minlength="8" data-parsley-equalto="#password">
					<?= form_error('passconfirm'); ?>
				</div>

				<div class="form-group">
					<label for="nama_user">Nama Lengkap <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="nama_user" name="nama_user" autocomplete="off" required>
					<?= form_error('nama_user'); ?>
				</div>

				<div class="form-group">
					<label for="telpon">Telpon</label>
					<input type="text" class="form-control" id="telpon" name="telpon" autocomplete="off">
					<?= form_error('telpon'); ?>
				</div>

				<div class="row mb-3">
					<div class="col-md-6">
						<div class="form-group">
							<label for="id_profil">Profil <span class="text-danger">*</span></label>
							<select id="id_profil" class="select2bs4 form-control" name="id_profil" required>
								<option value="">-- Pilih Profil --</option>
								<?php foreach ($profil as $p) : ?>
									<option value="<?= $p->id_profil; ?>"><?= $p->profil; ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error('id_profil'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="aktif">Aktif <span class="text-danger">*</span></label>
							<select id="aktif" class="form-control" name="aktif" required>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
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
						<img id="prev" src="<?= base_url('assets/img/noprofil.png'); ?>" height="270">
					</div>
				</div>

				<a class="mr-2 mt-3 btn btn-warning " href="<?= base_url('user'); ?>" role="button">
					<i class="fa fa-arrow-left"></i> Batal
				</a>
				<button class="mt-3 btn btn-primary" type="submit">Tambah <i class="fas fa-paper-plane"></i></button>

			</form>

		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/footer.php'); ?>