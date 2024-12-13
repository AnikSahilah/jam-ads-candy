<?php

namespace App\Controllers\admin;

use App\Models\AktivitasModel;

class Aktivitas extends BaseController
{
    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitas_model = new AktivitasModel();
        $all_data_aktivitas = $aktivitas_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/aktivitas/index', [
            'all_data_aktivitas' => $all_data_aktivitas,
            'validation' => $validation
        ]);
    }

    public function tambah()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitas_model = new AktivitasModel();
        $all_data_aktivitas = $aktivitas_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/aktivitas/tambah', [
            'all_data_aktivitas' => $all_data_aktivitas,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $file_foto = $this->request->getFile('foto_aktivitas');
        $currentDateTime = date('dmYHis');
        $nama_aktivitas_in = $this->request->getVar("nama_aktivitas_in");
        $nama_aktivitas_en = $this->request->getVar("nama_aktivitas_en");

        // Validasi nama aktivitas Indonesia
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_aktivitas_in)) {
            session()->setFlashdata('error', 'Nama aktivitas Indonesia hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi nama aktivitas Inggris
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_aktivitas_en)) {
            session()->setFlashdata('error', 'Nama aktivitas Inggris hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        if (!$this->validate([
            'foto_aktivitas' => [
                'rules' => 'uploaded[foto_aktivitas]|is_image[foto_aktivitas]|max_dims[foto_aktivitas,572,572]|mime_in[foto_aktivitas,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'max_dims' => 'Maksimal ukuran gambar 572x572 pixels',
                    'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $newFileName = "{$nama_aktivitas_en}_{$nama_aktivitas_in}_{$currentDateTime}.{$file_foto->getExtension()}";
            $file_foto->move('asset-user/images', $newFileName);

            $aktivitasModel = new AktivitasModel();

            // Menghasilkan slug dari nama aktivitas
            $slug_id = url_title($nama_aktivitas_in, '-', true);
            $slug_en = url_title($nama_aktivitas_en, '-', true);

            $data = [
                'nama_aktivitas_in' => $nama_aktivitas_in,
                'nama_aktivitas_en' => $nama_aktivitas_en,
                'deskripsi_aktivitas_in' => $this->request->getVar("deskripsi_aktivitas_in"),
                'deskripsi_aktivitas_en' => $this->request->getVar("deskripsi_aktivitas_en"),
                'foto_aktivitas' => $newFileName,
                'meta_title' => $this->request->getVar("meta_title_in"),
                'meta_description' => $this->request->getVar("meta_description_in"),
                'meta_title_inggris' => $this->request->getVar("meta_title_en"),
                'meta_description_inggris' => $this->request->getVar("meta_description_en"),
                'slug_id' => $slug_id, // Slug otomatis untuk bahasa Indonesia
                'slug_en' => $slug_en // Slug otomatis untuk bahasa Inggris
            ];
            $aktivitasModel->save($data);

            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url('admin/aktivitas/index'));
        }
    }

    public function edit($id_aktivitas)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitas_model = new AktivitasModel();
        $aktivitasData = $aktivitas_model->find($id_aktivitas);
        $validation = \Config\Services::validation();

        return view('admin/aktivitas/edit', [
            'aktivitasData' => $aktivitasData,
            'validation' => $validation
        ]);
    }

    public function proses_edit($id_aktivitas = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $file_foto = $this->request->getFile('foto_aktivitas');
        $currentDateTime = date('dmYHis');
        $nama_aktivitas_in = $this->request->getVar("nama_aktivitas_in");
        $nama_aktivitas_en = $this->request->getVar("nama_aktivitas_en");

        if (!$id_aktivitas) {
            return redirect()->back();
        }

        $aktivitasModel = new AktivitasModel();
        $aktivitasData = $aktivitasModel->find($id_aktivitas);

        // Validasi nama aktivitas Indonesia
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_aktivitas_in)) {
            session()->setFlashdata('error', 'Nama aktivitas Indonesia hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi nama aktivitas Inggris
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_aktivitas_en)) {
            session()->setFlashdata('error', 'Nama aktivitas Inggris hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Generate slug dari nama aktivitas
        $slug_id = url_title($nama_aktivitas_in, '-', true);
        $slug_en = url_title($nama_aktivitas_en, '-', true);

        // Periksa apakah ada file 'foto_aktivitas' yang baru diunggah
        if ($file_foto->isValid() && !$file_foto->hasMoved()) {
            // Hapus file foto lama jika ada
            if ($aktivitasData && file_exists('asset-user/images/' . $aktivitasData->foto_aktivitas)) {
                unlink('asset-user/images/' . $aktivitasData->foto_aktivitas);
            }

            // Unggah file foto baru
            $newFileName = "{$nama_aktivitas_en}_{$nama_aktivitas_in}_{$currentDateTime}.{$file_foto->getExtension()}";
            $file_foto->move('asset-user/images', $newFileName);
        } else {
            // Jika tidak ada file baru, gunakan nama file lama
            $newFileName = $aktivitasData->foto_aktivitas;
        }

        // Data yang akan diperbarui
        $data = [
            'foto_aktivitas' => $newFileName,
            'nama_aktivitas_in' => $nama_aktivitas_in,
            'nama_aktivitas_en' => $nama_aktivitas_en,
            'deskripsi_aktivitas_in' => $this->request->getPost("deskripsi_aktivitas_in"),
            'deskripsi_aktivitas_en' => $this->request->getPost("deskripsi_aktivitas_en"),
            'meta_title' => $this->request->getPost("meta_title_in"),
            'meta_description' => $this->request->getPost("meta_description_in"),
            'meta_title_inggris' => $this->request->getPost("meta_title_en"),
            'meta_description_inggris' => $this->request->getPost("meta_description_en"),
            'slug_id' => $slug_id,
            'slug_en' => $slug_en
        ];

        // Perbarui data aktivitas di database
        $aktivitasModel->update($id_aktivitas, $data);

        session()->setFlashdata('success', 'Data aktivitas berhasil diperbarui.');
        return redirect()->to(base_url('admin/aktivitas/index'));
    }

    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitasModel = new AktivitasModel();

        $data = $aktivitasModel->find($id);

        unlink('asset-user/images/' . $data->foto_aktivitas);

        $aktivitasModel->delete($id);

        return redirect()->to(base_url('admin/aktivitas/index'));
    }
}
