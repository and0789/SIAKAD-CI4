<?php

namespace App\Controllers;

use App\Models\FakultasModel;

class Fakultas extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->FakultasModel = new FakultasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Fakultas',
            'fakultas' => $this->FakultasModel->allData(),
            'content' => 'admin/v_fakultas',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = [
            'fakultas' => $this->request->getPost('fakultas'),
        ];
        $this->FakultasModel->add($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambah');
        return redirect()->to(base_url('fakultas'));
    }

    public function edit($id_fakultas)
    {
        $data = [
            'id_fakultas' => $id_fakultas,
            'fakultas' => $this->request->getPost('fakultas'),
        ];
        $this->FakultasModel->edit($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to(base_url('fakultas'));
    }

    public function delete($id_fakultas)
    {
        $data = [
            'id_fakultas' => $id_fakultas,
        ];
        $this->FakultasModel->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil Hapus');
        return redirect()->to(base_url('fakultas'));
    }
}
