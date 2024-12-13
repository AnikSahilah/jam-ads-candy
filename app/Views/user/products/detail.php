<?= $this->extend('user/template/template') ?>
<?= $this->section('content'); ?>

<div class="container-fluid bg-primary py-5 mb-5 page-header" style="background-image: url('<?= base_url('asset-user/images/watch (1) (1).jpg'); ?>'); background-size: cover;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <?php if (!empty($profil)): ?>
                    <h1 class="display-3 text-white animated slideInDown">
                        <?= lang('Blog.titleOurproducts') . ' ' . $profil[0]->nama_perusahaan; ?>
                    </h1>
                <?php else: ?>
                    <h1 class="display-3 text-white animated slideInDown"><?= lang('Blog.titleOurproducts'); ?></h1>
                <?php endif; ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="<?= base_url('/') ?>"><?= lang('Blog.headerHome'); ?></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><?= lang('Blog.headerProducts'); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<?php if (isset($profil) && is_iterable($profil)): ?>
    <?php foreach ($profil as $descper): ?>
        <div class="container py-3">
            <div class="row py-5">
                <div class="col-lg-5">
                    <div class="row px-3">
                        <div class="col-12 p-0">
                            <?php if (isset($tbproduk)): ?>
                                <img class="img-fluid w-100 lazyload"
                                    data-src="<?= base_url('asset-user/images/' . $tbproduk->foto_produk); ?>"
                                    alt="<?= lang('Blog.Languange') == 'en' ? $tbproduk->nama_produk_en : $tbproduk->nama_produk_in; ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
                    <h1 class="text-primary">
                        <b>
                            <?php if (isset($tbproduk)): ?>
                                <?= lang('Blog.Languange') == 'en' ? $tbproduk->nama_produk_en : $tbproduk->nama_produk_in; ?>
                            <?php endif; ?>
                        </b>
                    </h1>
                    <p>
                        <?php if (isset($tbproduk)): ?>
                            <?= lang('Blog.Languange') == 'en' ? $tbproduk->deskripsi_produk_en : $tbproduk->deskripsi_produk_in; ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p><?= lang('Blog.noProfileFound'); ?></p>
<?php endif; ?>

<?= $this->endSection('content'); ?>