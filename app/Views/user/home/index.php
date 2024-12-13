<?= $this->extend('user/template/template') ?>
<?= $this->section('content'); ?>

<?= $this->include('user/home/slider'); ?>

<!-- About Start -->
<div class="container-xxl py-5 mb-5">
    <div class="container">
        <div class="about-title text-center mb-5">
            <p class="title-text"><?= $profil[0]->title_website ?? ''; ?></p>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative h-100 d-flex justify-content-center">
                    <img class="img-fluid lazyload" data-src="asset-user/images/<?= $profil[0]->foto_utama; ?>" alt="<?= $profil[0]->nama_perusahaan; ?>" style="object-fit: cover; border-radius: 10px;">
                </div>
            </div>
            <div class="col-lg-7 wow fadeInUp">
                <h6 class="section-title bg-white text-start text-primary pe-3"><?= lang('Blog.titleAboutUs') ?></h6>
                <h1 class="mb-4"><?= $profil[0]->nama_perusahaan; ?></h1>
                <p class="mb-4"><?= lang('Blog.Languange') == 'en' ? character_limiter($profil[0]->deskripsi_perusahaan_en, 700) : character_limiter($profil[0]->deskripsi_perusahaan_in, 700); ?></p>
                <a class="btn btn-primary py-3 px-5 mt-2" href="<?= base_url($lang . '/' . ($lang === 'en' ? 'about' : 'tentang-kami')) ?>"><?= lang('Blog.btnReadmore'); ?></a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Latest Articles Start -->
<div class="container-xxl py-1 mb-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3"><?= lang('Blog.headerArticle'); ?></h3>
        </div>
        <div class="row pt-5">
            <?php foreach (array_slice($artikelterbaru, 0, 3) as $row) : ?>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 mb-2 h-100 d-flex flex-column">
                        <a href="<?= base_url('/artikel/detail/' . $row->id_artikel) ?>" class="img-link">
                            <img data-src="<?= base_url('asset-user/images/' . $row->foto_artikel) ?>" alt="<?= $row->judul_artikel ?>" class="card-img-top lazyload" style="object-fit: cover; border-radius: 10px;">
                        </a>
                        <div class="card-body bg-light p-4 d-flex flex-column flex-grow-1">
                            <b><a style="font-size: 20px;" class="card-title flex-grow-1" href="<?= base_url('/artikel/detail/' . $row->id_artikel) ?>"><?= $row->judul_artikel ?></a></b>
                            <div class="mb-2">
                                <a class="text-uppercase mb-3 text-body"><?= date('d F Y', strtotime($row->created_at)); ?></a>
                            </div>
                            <p><?= substr(strip_tags($row->deskripsi_artikel), 0, 100) ?>...</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-primary py-3 px-5" href="<?= base_url('/artikel') ?>">Lihat Semua Artikel</a>
        </div>
    </div>
</div>
<!-- Latest Articles End -->

<!-- Product Start -->
<div class="container-xxl py-1 mb-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3"><?= lang('Blog.btnOurproducts'); ?></h3>
        </div>
        <div class="row pt-5">
            <?php foreach (array_slice($tbproduk, 0, 3) as $produk) : ?>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 mb-2 h-100 d-flex flex-column">
                        <a href="<?= base_url('product/detail/' . $produk->id_produk . '/' . url_title($produk->nama_produk_en) . '_' . url_title($produk->nama_produk_in)) ?>" class="img-link">
                            <img data-src="./asset-user/images/<?= $produk->foto_produk ?>" alt="<?= lang('Blog.Languange') == 'en' ? $produk->nama_produk_en : $produk->nama_produk_in; ?>" class="card-img-top lazyload" style="object-fit: cover; border-radius: 10px;">
                        </a>
                        <div class="card-body bg-light p-4 d-flex flex-column flex-grow-1 text-center">
                            <b><a style="font-size: 20px;" class="card-title flex-grow-1" href="<?= base_url('product/detail/' . $produk->id_produk . '/' . url_title($produk->nama_produk_en) . '_' . url_title($produk->nama_produk_in)) ?>"><?= lang('Blog.Languange') == 'en' ? $produk->nama_produk_en : $produk->nama_produk_in; ?></a></b>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-primary py-3 px-5" href="<?= base_url('/product') ?>">Lihat Semua Produk</a>
        </div>
    </div>
</div>
<!-- Product End -->

<!-- Activities Start -->
<div class="container-xxl py-1 mb-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3"><?= lang('Blog.btnOuractivities'); ?></h3>
        </div>
        <div class="row pt-5">
            <?php foreach (array_slice($tbaktivitas, 0, 3) as $aktivitas) : ?>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 mb-2 h-100 d-flex flex-column">
                        <a href="<?= base_url('activities/detail/' . $aktivitas->id_aktivitas . '/' . url_title($aktivitas->nama_aktivitas_en) . '_' . url_title($aktivitas->nama_aktivitas_in)) ?>" class="img-link">
                            <img data-src="./asset-user/images/<?= $aktivitas->foto_aktivitas ?>" alt="<?= lang('Blog.Languange') == 'en' ? $aktivitas->nama_aktivitas_en : $aktivitas->nama_aktivitas_in; ?>" class="card-img-top lazyload" style="object-fit: cover; border-radius: 10px;">
                        </a>
                        <div class="card-body bg-light p-4 d-flex flex-column flex-grow-1 text-center">
                            <b><a style="font-size: 20px;" class="card-title flex-grow-1" href="<?= base_url('activities/detail/' . $aktivitas->id_aktivitas . '/' . url_title($aktivitas->nama_aktivitas_en) . '_' . url_title($aktivitas->nama_aktivitas_in)) ?>"><?= lang('Blog.Languange') == 'en' ? $aktivitas->nama_aktivitas_en : $aktivitas->nama_aktivitas_in; ?></a></b>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-primary py-3 px-5" href="<?= base_url('/activities') ?>">Lihat Semua Aktivitas</a>
        </div>
    </div>
</div>
<!-- Activities End -->

<?= $this->endSection(); ?>