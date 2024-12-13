<?= $this->extend('user/template/template') ?>
<?= $this->section('content'); ?>

<div class="container-fluid bg-primary py-5 mb-5 page-header" style="background-image: url('asset-user/images/watch (1) (1).jpg'); background-size: cover;">
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

<!-- Product Start -->
<?php
function compareById($a, $b)
{
    return $b->id_produk - $a->id_produk;
}

usort($tbproduk, 'compareById');
?>

<div class="container-xxl py-1 mb-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3"><?= lang('Blog.btnOurproducts'); ?></h3>
        </div>
        <div class="row pt-5">
            <?php foreach ($tbproduk as $produk): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 mb-2 h-100 d-flex flex-column">
                        <a href="<?= base_url(($lang === 'en' ? 'en/product/' . esc($produk->slug_en) : 'id/produk/' . esc($produk->slug_id))) ?>" class="img-link">
                            <img data-src="<?= base_url('asset-user/images/' . esc($produk->foto_produk)) ?>" alt="<?= lang('Blog.Languange') == 'en' ? esc($produk->slug_en) : esc($produk->slug_id); ?>" class="card-img-top lazyload">
                        </a>
                        <div class="card-body bg-light p-4 d-flex flex-column flex-grow-1 text-center">
                            <b>
                                <a style="font-size: 20px; overflow-wrap: break-word;" class="card-title flex-grow-1" href="<?= base_url(($lang === 'en' ? 'en/product/' . esc($produk->slug_en) : 'id/produk/' . esc($produk->slug_id))) ?>">
                                    <?= lang('Blog.Languange') == 'en/product' ? $produk->slug_en : $produk->slug_id; ?>
                                </a>
                            </b>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-primary py-3 px-5" href="<?= base_url('/product') ?>"><?= lang('SeeAllProducts'); ?></a>
        </div>
    </div>
</div>
<!-- Product End -->

<?= $this->endSection('content'); ?>