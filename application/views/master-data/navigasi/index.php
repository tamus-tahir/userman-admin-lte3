<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content p-3">

		<div class="rounded mt-4 mb-3 p-4 bg-white shadow-lg border-left-success ">
			<h1 class="h3 text-black"><?= $title; ?></h1>
		</div>

		<div class="tampil-modal"></div>

		<div class="rounded mt-4 mb-5 p-4 bg-white shadow-lg border-left-primary ">
			<?php if ($akses->tambah == 1) : ?>
				<button type="button" class="btn btn-outline-success mb-3 addForm mr-2" data-toggle="modal" data-target="#exampleModal">
					Tambah <i class="fas fa-plus"></i>
				</button>
			<?php endif ?>
			<button type="button" class="btn btn-primary mb-3">Total Data : <?= $num; ?></button>

			<div class="table-responsive">
				<table class="table table-hover table-bordered text-nowrap text-center" id="myTable">
					<thead class="bg-primary text-white ">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Navigasi</th>
							<th scope="col">Heading</th>
							<th scope="col">Url</th>
							<th scope="col">Icon</th>
							<th scope="col">navigasi Utama</th>
							<th scope="col">Urutan</th>
							<th scope="col">Aktif</th>
							<th scope="col" class="td-aksi">Action</th>
						</tr>
					</thead>
					<tbody class="text-black">
						<?php $i = 1; ?>
						<?php foreach ($navigasi as $k) : ?>
							<tr>
								<td scope="row"><?= $i++; ?></td>
								<td class="text-left"><?= $k->navigasi; ?></td>
								<td class="text-left"><?= $k->heading; ?></td>
								<td><?= $k->url; ?></td>
								<td><i class="<?= $k->icon; ?> text-info fa-2x"></i></td>

								<?php $data = $this->Default_m->getWhere('tabel_navigasi', ['id_navigasi' => $k->dropdown])->row(); ?>

								<td><?= $k->dropdown == 0 ? 'Root' : $data->navigasi; ?></td>

								<td><?= $k->urutan; ?></td>
								<td><?= $k->aktif; ?></td>
								<td class="text-nowarp">
									<?php if ($akses->ubah == 1) : ?>
										<a href="#" class="updateForm btn btn-outline-warning" data-id="<?= $k->id_navigasi; ?>" data-toggle="modal" data-target="#exampleModal" data-token="<?= generate($k->id_navigasi); ?>">
											<i class="fas fa-edit pop" data-toggle="popover" data-placement="bottom" data-content="Update"></i>
										</a>
									<?php endif ?>
									<?php if ($akses->hapus == 1) : ?>
										<a href="<?= base_url('navigasi/hapus/' . $k->id_navigasi . '/' . generate($k->id_navigasi)); ?>" class="button-delete btn btn-outline-danger">
											<i class="fas fa-trash-alt pop" ata-toggle="popover" data-placement="bottom" data-content="Delete"></i>
										</a>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<?php $this->load->view('master-data/navigasi/form') ?>
<?php $this->load->view('master-data/navigasi/modal') ?>
<?php $this->load->view('templates/footer.php'); ?>