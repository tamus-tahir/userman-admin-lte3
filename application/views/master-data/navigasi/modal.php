<div class="modal fade " id="modal-icon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Icon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row justify-content-end mb-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="keyword-icon" name="keyword" autocomplete="off" placeholder="Cari Icon">
                    </div>
                </div>

                <div style="max-height: 600px" class="overflow-auto" id="data-icon">
                    <!-- <?php foreach ($icon as $k) : ?>
                        <div class="d-inline-flex">
                            <button type="button" class="btn btn-outline-secondary get-icon m-2" data-id="<?= $k->id_icon; ?>" data-icon="<?= $k->icon; ?>" data-dismiss="modal">
                                <i class="<?= $k->icon; ?> fa-2x"></i>
                            </button>
                        </div>
                    <?php endforeach; ?> -->
                </div>


                <!-- <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center" id="myTable3">
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
                                    <td scope="row"><?= $i; ?></td>
                                    <td class="text-left"><?= $k->icon; ?></td>
                                    <td><i class="<?= $k->icon; ?> text-secondary fa-2x"></i></td>
                                    <td class="text-nowarp">
                                        <button type="button" class="btn btn-outline-primary get-icon" data-id="<?= $k->id_icon; ?>" data-icon="<?= $k->icon; ?>" data-dismiss="modal">Pilih</button>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>