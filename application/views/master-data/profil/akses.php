<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content p-3">

		<div class="rounded mt-4 mb-3 p-4 bg-white shadow-lg border-left-success ">
			<h1 class="h3 text-black"><?= $title; ?></h1>
		</div>

		<div class="rounded mt-4 mb-5 p-4 bg-white shadow-lg border-left-primary ">

			<a class="mb-4 mt-2 btn btn-outline-warning" href="<?= base_url('profil'); ?>" role="button">
				<i class="fa fa-arrow-left"></i> Kembali
			</a>
			<button type="button" class="btn btn-primary mb-3">Profil : <?= $profil->profil; ?></button>

			<div class="table-responsive">
				<table class="table table-hover table-bordered text-center">
					<thead class="bg-primary text-white">
						<tr>
							<th scope="col" width="20px" colspan="2" rowspan="2">#</th>
							<th scope="col" rowspan="2">navigasi</th>
							<th scope="col" colspan="4">Action</th>
						</tr>
						<tr>
							<th scope="col">Read</th>
							<th scope="col">Create</th>
							<th scope="col">Update</th>
							<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody class="text-black">
						<?php $i = 1; ?>
						<?php $navigasi = $this->db->get_where('tabel_navigasi', ['dropdown' => 0])->result(); ?>
						<?php foreach ($navigasi as $m) : ?>
							<tr class="<?= $m->dropdown == 0 ? 'bg-gray-200' : ''; ?>">
								<td colspan="2"><?= $i; ?></td>
								<td class="text-left"><?= $m->navigasi; ?></td>

								<!-- read -->
								<td>
									<div class="form-check">
										<input type="checkbox" class="form-check-input change-akses" id="exampleCheck1">
									</div>
									<div class="form-check">
										<input class="form-check-input change-akses" type="checkbox" <?= check_access($profil->id_profil, $m->id_navigasi); ?> data-profil="<?= $profil->id_profil; ?>" data-navigasi="<?= $m->id_navigasi; ?>" data-url="changeaccess">
									</div>
								</td>
								<!-- end read -->

								<?php $cek = $this->db->get_where('tabel_akses', ['id_profil' => $profil->id_profil, 'id_navigasi' => $m->id_navigasi])->num_rows(); ?>
								<?php if ($m->cud == 'Yes') : ?>
									<?php if ($cek) : ?>
										<!-- create -->
										<td>
											<div class="form-check">
												<input type="checkbox" class="form-check-input change-akses" id="exampleCheck1">
											</div>
											<div class="form-check">
												<input class="form-check-input change-akses" type="checkbox" <?= check_access_cread($profil->id_profil, $m->id_navigasi); ?> data-profil="<?= $profil->id_profil; ?>" data-navigasi="<?= $m->id_navigasi; ?>" data-url="changeCreate">
											</div>
										</td>
										<!-- end create -->

										<!-- update -->
										<td>
											<div class="form-check">
												<input type="checkbox" class="form-check-input change-akses" id="exampleCheck1">
											</div>
											<div class="form-check">
												<input class="form-check-input change-akses" type="checkbox" <?= check_access_update($profil->id_profil, $m->id_navigasi); ?> data-profil="<?= $profil->id_profil; ?>" data-navigasi="<?= $m->id_navigasi; ?>" data-url="changeUpdate">
											</div>
										</td>
										<!-- end update -->

										<!-- end delete -->
										<td>
											<div class="form-check">
												<input type="checkbox" class="form-check-input change-akses" id="exampleCheck1">
											</div>
											<div class="form-check">
												<input class="form-check-input change-akses" type="checkbox" <?= check_access_delete($profil->id_profil, $m->id_navigasi); ?> data-profil="<?= $profil->id_profil; ?>" data-navigasi="<?= $m->id_navigasi; ?>" data-url="changeDelete">
											</div>
										</td>
										<!-- end delete -->
									<?php endif ?>
								<?php endif ?>
							</tr>

							<?php $data = $this->db->get_where('tabel_navigasi', ['dropdown' => $m->id_navigasi])->result(); ?>
							<?php $x = 'a'; ?>
							<?php foreach ($data as $d) : ?>
								<tr>
									<td width="20px"></td>
									<td class="text-center" width="20px"><?= $x; ?></td>
									<td class="text-left"><?= $d->navigasi; ?></td>

									<!-- read -->
									<td>
										<div class="form-check">
											<input type="checkbox" class="form-check-input change-akses" id="exampleCheck1">
										</div>
										<div class="form-check">
											<input class="form-check-input change-akses" type="checkbox" <?= check_access($profil->id_profil, $d->id_navigasi); ?> data-profil="<?= $profil->id_profil; ?>" data-navigasi="<?= $d->id_navigasi; ?>" data-url="changeaccess">
										</div>
									</td>
									<!-- end read -->

									<?php $cekDropdown = $this->db->get_where('tabel_akses', ['id_profil' => $profil->id_profil, 'id_navigasi' => $d->id_navigasi])->num_rows(); ?>
									<?php if ($cekDropdown) : ?>
										<?php if ($d->cud == 'Yes') : ?>
											<!-- create -->
											<td>
												<div class="form-check">
													<input type="checkbox" class="form-check-input change-akses" id="exampleCheck1">
												</div>
												<div class="form-check">
													<input class="form-check-input change-akses" type="checkbox" <?= check_access_cread($profil->id_profil, $d->id_navigasi); ?> data-profil="<?= $profil->id_profil; ?>" data-navigasi="<?= $d->id_navigasi; ?>" data-url="changeCreate">
												</div>
											</td>
											<!-- end create -->

											<!-- update -->
											<td>
												<div class="form-check">
													<input type="checkbox" class="form-check-input change-akses" id="exampleCheck1">
												</div>
												<div class="form-check">
													<input class="form-check-input change-akses" type="checkbox" <?= check_access_update($profil->id_profil, $d->id_navigasi); ?> data-profil="<?= $profil->id_profil; ?>" data-navigasi="<?= $d->id_navigasi; ?>" data-url="changeUpdate">
												</div>
											</td>
											<!-- end update -->

											<!-- end delete -->
											<td>
												<div class="form-check">
													<input type="checkbox" class="form-check-input change-akses" id="exampleCheck1">
												</div>
												<div class="form-check">
													<input class="form-check-input change-akses" type="checkbox" <?= check_access_delete($profil->id_profil, $d->id_navigasi); ?> data-profil="<?= $profil->id_profil; ?>" data-navigasi="<?= $d->id_navigasi; ?>" data-url="changeDelete">
												</div>
											</td>
											<!-- end delete -->
										<?php endif ?>
									<?php endif ?>

								</tr>
								<?php $x++; ?>
							<?php endforeach ?>

							<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/footer.php'); ?>