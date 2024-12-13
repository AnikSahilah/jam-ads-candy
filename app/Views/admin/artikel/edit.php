<?= $this->extend('admin/template/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Artikel</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="card-body">
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-danger" role="alert">
                            <h4>Error</h4>
                            <p><?php echo session()->getFlashdata('error'); ?></p>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('admin/artikel/proses_edit/' . $artikelData->id_artikel ?? '') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <?php if (isset($artikelData)) : ?>
                                    <input type="text" class="form-control" id="id_artikel" name="id_artikel" value="<?= $artikelData->id_artikel ?>" hidden>

                                    <div class="mb-3">
                                        <label class="form-label">Judul Artikel</label>
                                        <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" value="<?= $artikelData->judul_artikel; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Artikel</label>
                                        <textarea type="text" class="form-control tiny" id="deskripsi_artikel" name="deskripsi_artikel"><?= $artikelData->deskripsi_artikel; ?></textarea>
                                    </div>

                                    <!-- Tambahkan Judul Inggris -->
                                    <div class="mb-3">
                                        <label class="form-label">Judul Artikel (Inggris)</label>
                                        <input type="text" class="form-control" id="judul_inggris" name="judul_inggris" value="<?= $artikelData->judul_inggris ?? ''; ?>" placeholder="Masukkan Judul Artikel dalam Bahasa Inggris">
                                    </div>
                                    <!-- Tambahkan Deskripsi Inggris -->
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Artikel (Inggris)</label>
                                        <textarea type="text" class="form-control tiny" id="description_inggris" name="description_inggris" placeholder="Masukkan Deskripsi Artikel dalam Bahasa Inggris"><?= $artikelData->description_inggris ?? ''; ?></textarea>
                                    </div>

                                    <!-- Tambahkan Meta Title -->
                                    <div class="mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $artikelData->meta_title ?? ''; ?>" placeholder="Masukkan Meta Title">
                                    </div>
                                    <!-- Tambahkan Meta Title Inggris -->
                                    <div class="mb-3">
                                        <label class="form-label">Meta Title Inggris</label>
                                        <input type="text" class="form-control" id="meta_title_inggris" name="meta_title_inggris" value="<?= $artikelData->meta_title_inggris ?? ''; ?>" placeholder="Masukkan Meta Title dalam Bahasa Inggris">
                                    </div>
                                    <!-- Tambahkan Meta Description -->
                                    <div class="mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <textarea type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Masukkan Meta Description"><?= $artikelData->meta_description ?? ''; ?></textarea>
                                    </div>
                                    <!-- Tambahkan Meta Description Inggris -->
                                    <div class="mb-3">
                                        <label class="form-label">Meta Description Inggris</label>
                                        <textarea type="text" class="form-control" id="meta_description_inggris" name="meta_description_inggris" placeholder="Masukkan Meta Description dalam Bahasa Inggris"><?= $artikelData->meta_description_inggris ?? ''; ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Gambar Artikel</label>
                                        <input type="file" class="form-control" id="foto_artikel" name="foto_artikel">
                                        <img width="150px" class="img-thumbnail" src="<?= base_url() . "asset-user/images/" . $artikelData->foto_artikel; ?>">
                                        <?php if ($validation ?? false && $validation->hasError('foto_artikel')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('foto_artikel') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <p>*Ukuran foto maksimal 572x572 pixels</p>
                                    <p>*Foto harus berekstensi jpg/png/jpeg</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            <div class="col">
                                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo session()->getFlashdata('success') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--//app-card-->
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

<?= $this->endSection('content') ?>