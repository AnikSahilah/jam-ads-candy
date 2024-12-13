<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        <?php if (isset($tbslider) && is_iterable($tbslider)) : ?>
            <?php foreach ($tbslider as $key => $slider) : ?>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid lazyload slider-image" data-src="./asset-user/images/<?= $slider->file_foto_slider; ?>" 
                        <?php if (isset($profil) && is_iterable($profil)) : ?>
                            <?php foreach ($profil as $perusahaan) : ?> 
                                alt="<?= $perusahaan->nama_perusahaan; ?>" 
                            <?php endforeach; ?>
                        <?php endif; ?>
                    /> <!-- Menambahkan tag penutup untuk <img> -->
                </div> <!-- Menambahkan penutup untuk <div> -->
            <?php endforeach; ?>
        <?php else : ?>
            <p><?php echo lang('Blog.noSliderFound'); ?></p>
        <?php endif; ?>
    </div>
</div>
<!-- Carousel End -->

<style>

.slider-image {
    max-height: 70vh;
    object-fit: cover;
    width: 100%;
}
</style>