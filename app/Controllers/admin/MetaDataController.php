<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Metadatamodels;

class MetaDataController extends BaseController
{
    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Returns an HTML view with a list of metadata.
     *
     * @return mixed
     */
    /******  6f4f33e7-cc1f-45aa-9a79-7d610fe45a2e  *******/
    protected $metaModel;

    public function __construct()
    {
        $this->metaModel = new Metadatamodels();
    }

    public function index()
    {
        $data['meta_data'] = $this->metaModel->findAll();
        return view('admin/metadata/index', $data);
    }

    public function create()
    {
        return view('admin/metadata/create');
    }

    public function store()
    {
        $this->metaModel->save([
            'feature' => $this->request->getPost('feature'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_title_inggris' => $this->request->getPost('meta_title_inggris'),
            'meta_description_inggris' => $this->request->getPost('meta_description_inggris'),
        ]);

        return redirect()->to('admin/meta_data')->with('success', 'Meta data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['meta'] = $this->metaModel->find($id);
        return view('admin/metadata/edit', $data);
    }

    public function update($id)
    {
        $this->metaModel->update($id, [
            'feature' => $this->request->getPost('feature'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_title_inggris' => $this->request->getPost('meta_title_inggris'),
            'meta_description_inggris' => $this->request->getPost('meta_description_inggris'),
        ]);

        return redirect()->to('admin/meta_data')->with('success', 'Meta data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->metaModel->delete($id);
        return redirect()->to('admin/meta_data')->with('success', 'Meta data berhasil dihapus.');
    }
}
