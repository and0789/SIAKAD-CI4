<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GedungModel;
use App\Models\RuanganModel;

class Ruangan extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->RuanganModel = new RuanganModel();
        $this->GedungModel = new GedungModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Ruangan',
            'ruangan' => $this->RuanganModel->allData(),
            'content' => 'admin/ruangan/v_index',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Ruangan',
            'gedung' => $this->GedungModel->allData(),
            'content' => 'admin/ruangan/v_tambah',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function insert()
    {
        if ($this->validate([
            'id_gedung' => [
                'label' => 'Gedung',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],

            'ruangan' => [
                'label' => 'Ruangan',
                'rules' => 'required|is_unique[tbl_ruangan.ruangan]',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'is_unique' => 'Nama {field} sudah ada, silahkan tambahkan yang lain'
                ]
            ],
        ])) {
            // jika valid
            $data = [
                'id_gedung' => $this->request->getPost('id_gedung'),
                'ruangan' => $this->request->getPost('ruangan'),
            ];
            $this->RuanganModel->add($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('ruangan'));

        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('ruangan/tambah'));

        }
    }

    public function edit($id_ruangan)
    {
        $data = [
            'title' => 'Edit Ruangan',
            'gedung' => $this->GedungModel->allData(),
            'ruangan' => $this->RuanganModel->detailData($id_ruangan),
            'content' => 'admin/ruangan/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_ruangan)
    {
        if ($this->validate([
            'id_gedung' => [
                'label' => 'Gedung',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],

            'ruangan' => [
                'label' => 'Ruangan',
                'rules' => 'required|is_unique[tbl_ruangan.ruangan]',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'is_unique' => 'Nama {field} sudah ada, silahkan tambahkan yang lain'
                ]
            ],
        ])) {
            // jika valid
            $data = [
                'id_ruangan' => $id_ruangan,
                'id_gedung' => $this->request->getPost('id_gedung'),
                'ruangan' => $this->request->getPost('ruangan'),
            ];
            $this->RuanganModel->edit($data);
            session()->setFlashdata('pesan', 'Data Berhasil Diubah');
            return redirect()->to(base_url('ruangan'));

        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('ruangan/edit/' . $id_ruangan));

        }
    }

    public function delete($id_ruangan)
    {
        $data = [
            'id_ruangan' => $id_ruangan,
        ];
        $this->RuanganModel->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil Hapus');
        return redirect()->to(base_url('ruangan'));
    }
}
