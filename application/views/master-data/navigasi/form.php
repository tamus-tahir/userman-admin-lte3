<div class="modal fade modal-action" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form navigasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form role="form" id="my-form" method="post">

                    <?= cekSessionCSRF(); ?>
                    <input type="hidden" name="<?= csrfName(); ?>" value="<?= $this->session->csrf_token; ?>">

                    <div class="form-group">
                        <label for="navigasi">Navigasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="navigasi" name="navigasi" autocomplete="off" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="url">Heading </label>
                            <input type="text" class="form-control" id="heading" name="heading" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label for="url">Url <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="url" name="url" autocomplete="off" required>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_icon">Icon </label>
                                <div class="input-group" data-toggle="modal" data-target="#modal-icon">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" name="icon" id="icon" class="form-control" placeholder="Cari Icon . . ." readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="dropdown">Dropdown <span class="text-danger">*</span></label>
                            <select id="dropdown" class="form-control cariProdi" name="dropdown">
                                <option value="0">No</option>
                                <?php $data = $this->Default_m->getAll('tabel_navigasi', 'id_navigasi')->result(); ?>
                                <?php foreach ($data as $d) : ?>

                                    <?php if ($d->dropdown == 0) : ?>
                                        <option value="<?= $d->id_navigasi; ?>"><?= $d->navigasi; ?></option>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </select>
                            <?= form_error('dropdown'); ?>
                        </div>
                        <div class="col-md-3">
                            <label for="urutan">Urutan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="urutan" name="urutan" required>
                        </div>
                        <div class="col-md-3">
                            <label for="aktif">Aktif <span class="text-danger">*</span></label>
                            <select id="aktif" class="form-control" name="aktif">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="cud">Create Update Delete <span class="text-danger">*</span></label>
                            <select id="cud" class="form-control" name="cud">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <span class="text-danger py-2">* (Tidak Boleh Kosong)</span>

                    <input type="hidden" name="id_navigasi" id="id_navigasi">
                    <input type="hidden" id="token" name="token">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-send"></button>

                </form>
                <!-- end form -->

            </div>
        </div>
    </div>
</div>