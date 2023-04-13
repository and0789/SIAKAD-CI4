<?php

namespace App\Controllers;

use App\Models\GedungModel;

class Gedung extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->GedungModel = new GedungModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Gedung',
            'gedung' => $this->GedungModel->allData(),
            'content' => 'admin/v_gedung',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = [
            'gedung' => $this->request->getPost('gedung'),
        ];
        $this->GedungModel->add($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambah');
        return redirect()->to(base_url('gedung'));
    }

    public function edit($id_gedung)
    {
        $data = [
            'id_gedung' => $id_gedung,
            'gedung' => $this->request->getPost('gedung'),
        ];
        $this->GedungModel->edit($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to(base_url('gedung'));
    }

    public function delete($id_gedung)
    {
        $data = [
            'id_gedung' => $id_gedung,
        ];
        $this->GedungModel->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil Hapus');
        return redirect()->to(base_url('gedung'));
    }
}
