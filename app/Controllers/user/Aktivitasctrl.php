<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\ProfilModel;
use App\Models\SliderModel;
use App\Models\ProdukModel;
use App\Models\AktivitasModel;

class Aktivitasctrl extends BaseController
{
    private $ProfilModel;
    private $SliderModel;
    private $ProdukModel;
    private $AktivitasModel;


    public function __construct()
    {
        $this->ProfilModel = new ProfilModel();
        $this->SliderModel = new SliderModel();
        $this->ProdukModel = new ProdukModel();
        $this->AktivitasModel = new AktivitasModel();
    }

    public function index($slug = null)
    {
        $lang = session()->get('lang') ?? 'en';

        // Ambil data dari model.
        $data = [
            'profil' => $this->ProfilModel->findAll(),
            'tbslider' => $this->SliderModel->findAll(),
            'tbproduk' => $this->ProdukModel->findAll(),
            'lang' => $lang,
            'isIndonesian' => $lang === 'id', // Tambahkan variabel ini
        ];

        helper('text');

        // Pastikan data profil tidak kosong.
        if (empty($data['profil'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data profil tidak ditemukan.');
        }

        // Ambil aktivitas sesuai dengan slug jika ada
        if ($slug === null) {
            $data['tbaktivitas'] = $this->AktivitasModel->findAll();
        } else {
            $slugField = $data['isIndonesian'] ? 'slug_id' : 'slug_en';
            $aktivitas = $this->AktivitasModel->where($slugField, $slug)->first();

            // Cek apakah data aktivitas ditemukan
            if (!$aktivitas) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Aktivitas tidak ditemukan.');
            }

            $data['tbaktivitas'] = [$aktivitas]; // Bungkus dalam array
        }

        // Siapkan data tambahan untuk view.
        $nama_perusahaan = $data['profil'][0]->nama_perusahaan ?? 'Perusahaan Tidak Diketahui';
        $deskripsi_perusahaan = strip_tags($data['isIndonesian'] ? $data['profil'][0]->deskripsi_perusahaan_in : $data['profil'][0]->deskripsi_perusahaan_en);

        // Judul dan teks meta.
        $data['Title'] = $data['isIndonesian'] ? ($aktivitas->nama_aktivitas_in ?? 'Aktivitas') : ($aktivitas->nama_aktivitas_en ?? 'Activities');
        $teks = ($data['isIndonesian'] ? 'Aktivitas dari ' : 'Activities of ') . $nama_perusahaan . '. ' . $deskripsi_perusahaan;

        // Batasi teks meta dengan jumlah karakter tertentu.
        $batasan = 150;
        $data['Meta'] = character_limiter($teks, $batasan);
        $data['aktivitas'] = $aktivitas ?? null;

        // Tampilkan view dengan data yang diperbarui.
        return view('user/aktivitas/index', $data);
    }

    public function detail($slug)
    {
        // Ambil bahasa dari sesi atau default ke bahasa Inggris
        $lang = session()->get('lang') ?? 'en';

        // Tentukan field slug berdasarkan bahasa
        $slugField = $lang === 'id' ? 'slug_id' : 'slug_en';

        // Ambil data dari model berdasarkan slug
        $data = [
            'profil' => $this->ProfilModel->findAll(),
            'tbaktivitas' => $this->AktivitasModel->where($slugField, $slug)->first(),
        ];

        helper('text');

        // Cek apakah data aktivitas ditemukan
        if (empty($data['tbaktivitas'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Aktivitas tidak ditemukan.');
        }

        // Ambil nama dan deskripsi aktivitas berdasarkan bahasa
        if ($lang === 'in') {
            $nama_aktivitas = $data['tbaktivitas']->nama_aktivitas_in;
            $deskripsi_aktivitas = strip_tags($data['tbaktivitas']->deskripsi_aktivitas_in);
            $data['Title'] = $nama_aktivitas ?? '';
        } else {
            $nama_aktivitas = $data['tbaktivitas']->nama_aktivitas_en;
            $deskripsi_aktivitas = strip_tags($data['tbaktivitas']->deskripsi_aktivitas_en);
            $data['Title'] = $nama_aktivitas ?? '';
        }

        // Buat teks meta
        $teks = "$nama_aktivitas. $deskripsi_aktivitas";
        $batasan = 150;
        $data['Meta'] = character_limiter($teks, $batasan);

        // Tampilkan view dengan data yang diperbarui
        return view('user/aktivitas/detail', $data);
    }
}
