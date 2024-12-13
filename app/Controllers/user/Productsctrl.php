<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\ProfilModel;
use App\Models\SliderModel;
use App\Models\ProdukModel;

class Productsctrl extends BaseController
{
    private $ProfilModel;
    private $SliderModel;
    private $ProdukModel;

    public function __construct()
    {
        $this->ProfilModel = new ProfilModel();
        $this->SliderModel = new SliderModel();
        $this->ProdukModel = new ProdukModel();

        helper(['text', 'url']);
    }

    public function index()
    {
        $lang = session()->get('lang') ?? 'en';
        $data = [
            'profil' => $this->ProfilModel->findAll(),
            'tbslider' => $this->SliderModel->findAll(),
            'tbproduk' => $this->ProdukModel->findAll(),
            'lang' => $lang
        ];

        // Pastikan data profil tidak kosong
        if (empty($data['profil'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data profil tidak ditemukan.');
        }

        helper('text');

        // Tentukan bahasa aktif
        $locale = session('lang') ?? service('request')->getLocale();

        if ($locale === 'id') {
            $nama_perusahaan = $data['profil'][0]->nama_perusahaan ?? 'Perusahaan Tidak Diketahui';
            $deskripsi_perusahaan = strip_tags($data['profil'][0]->deskripsi_perusahaan_in ?? 'Deskripsi tidak tersedia');

            $data['Title'] = $data['tbproduk'][0]->nama_produk_in ?? 'Produk';
            $teks = "Produk dari $nama_perusahaan. $deskripsi_perusahaan";
        } else {
            $nama_perusahaan = $data['profil'][0]->nama_perusahaan ?? 'Unknown Company';
            $deskripsi_perusahaan = strip_tags($data['profil'][0]->deskripsi_perusahaan_en ?? 'Description not available');

            $data['Title'] = $data['tbproduk'][0]->nama_produk_en ?? 'Products';
            $teks = "Products of $nama_perusahaan. $deskripsi_perusahaan";
        }

        $batasan = 150;
        $data['Meta'] = character_limiter($teks, $batasan);

        return view('user/products/index', $data);
    }

    public function detail($slug_produk)
    {
        // Mengambil produk berdasarkan slug
        $data = [
            'profil' => $this->ProfilModel->findAll(),
            'tbproduk' => $this->ProdukModel->where('slug_en', $slug_produk) // Ganti dengan 'slug_id' jika bahasa Indonesia
                ->orWhere('slug_id', $slug_produk) // Pastikan untuk menyesuaikan nama kolom slug untuk bahasa Indonesia
                ->first(),
        ];

        // Pastikan produk ditemukan
        if (!$data['tbproduk']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk dengan slug '$slug_produk' tidak ditemukan.");
        }

        helper('text');

        // Tentukan bahasa aktif
        $locale = session('lang') ?? service('request')->getLocale();

        if ($locale === 'id') {
            $nama_produk = $data['tbproduk']->nama_produk_in ?? 'Produk Tidak Diketahui';
            $deskripsi_produk = strip_tags($data['tbproduk']->deskripsi_produk_in ?? 'Deskripsi tidak tersedia');

            $data['Title'] = $data['tbproduk']->nama_produk_in ?? '';
            $teks = "$nama_produk. $deskripsi_produk";
        } else {
            $nama_produk = $data['tbproduk']->nama_produk_en ?? 'Unknown Product';
            $deskripsi_produk = strip_tags($data['tbproduk']->deskripsi_produk_en ?? 'Description not available');

            $data['Title'] = $data['tbproduk']->nama_produk_en ?? '';
            $teks = "$nama_produk. $deskripsi_produk";
        }

        $batasan = 150;
        $data['Meta'] = character_limiter($teks, $batasan);

        return view('user/products/detail', $data);
    }
}
