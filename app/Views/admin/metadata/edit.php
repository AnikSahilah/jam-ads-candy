<?= $this->extend('admin/template/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Meta Data</h1>
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

                    <form action="<?= base_url('/admin/meta_data/update/' . $meta['id']) ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Feature</label>
                                    <input type="text" class="form-control" id="feature" name="feature" value="<?= $meta['feature'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $meta['meta_title'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" required><?= $meta['meta_description'] ?></textarea>
                                </div>
                                <!-- Tambahkan Meta Title Inggris -->
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (Inggris)</label>
                                    <input type="text" class="form-control" id="meta_title_inggris" name="meta_title_inggris" value="<?= $meta['meta_title_inggris'] ?>" required>
                                </div>
                                <!-- Tambahkan Meta Description Inggris -->
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (Inggris)</label>
                                    <textarea class="form-control" id="meta_description_inggris" name="meta_description_inggris" required><?= $meta['meta_description_inggris'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
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

<?= $this->endSection('content'); ?>