<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content p-3">

		<div class="rounded mt-4 p-4 bg-white shadow-lg ">
			<h1 class="h3 text-black"><?= $title; ?></h1>
		</div>

		<div class="rounded mt-4 mb-5 p-4 bg-white shadow-lg ">
			<?php if ($akses->tambah == 1) : ?>
				<button type="button" class="btn btn-outline-success mb-3 addForm mr-2" data-toggle="modal" data-target="#exampleModal">
					Tambah <i class="fas fa-plus"></i>
				</button>
			<?php endif ?>
			<button type="button" class="btn btn-primary mb-3">Total Data : <?= $num; ?></button>

			<div class="table-responsive">
				<table class="table table-hover table-bordered text-center" id="myTable">
					<thead class="bg-primary text-white ">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Class</th>
							<th scope="col">Icon</th>
							<th scope="col" class="td-aksi">Action</th>
						</tr>
					</thead>
					<tbody class="text-black">
						<?php $i = 1; ?>
						<?php foreach ($icon as $k) : ?>
							<tr>
								<td scope="row"><?= $i++; ?></td>
								<td class="text-left"><?= $k->icon; ?></td>
								<td><i class="<?= $k->icon; ?> text-info fa-2x"></i></td>
								<td class="text-nowarp">
									<?php if ($akses->ubah == 1) : ?>
										<a href="#" class="updateForm btn btn-outline-warning" data-id="<?= $k->id_icon; ?>" data-toggle="modal" data-target="#exampleModal" data-token="<?= generate($k->id_icon); ?>">
											<i class="fas fa-edit pop" data-toggle="popover" data-placement="bottom" data-content="Update"></i>
										</a>
									<?php endif ?>
									<?php if ($akses->hapus == 1) : ?>
										<a href="<?= base_url('icon/hapus/' . $k->id_icon . '/' . generate($k->id_icon)); ?>" class="button-delete btn btn-outline-danger">
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

<?php $this->load->view('master-data/icon/form') ?>
<?php $this->load->view('templates/footer.php'); ?>