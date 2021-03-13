<div class="modal fade modal-action" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form role="form" id="my-form" method="post">

                    <?= cekSessionCSRF(); ?>
                    <input type="hidden" name="<?= csrfName(); ?>" value="<?= $this->session->csrf_token; ?>">

                    <div class="form-group">
                        <label for="profil">Profil <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="profil" name="profil" autocomplete="off" required>
                    </div>

                    <span class="text-danger py-2">* (Tidak Boleh Kosong)</span>
                    <input type="hidden" name="id_profil" id="id_profil">
                    <input type="hidden" name="token" id="token">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-cancel" data-dismiss="modal">Batal <i class="fa fa-times ml-2"></i></button>
                <button type="submit" class="btn btn-primary btn-send"></button>

                </form>
                <!-- end form -->

            </div>
        </div>
    </div>
</div>