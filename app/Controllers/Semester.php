<?php

namespace App\Controllers;

use App\Models\SemesterModel;

class Semester extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->SemesterModel = new SemesterModel();
    }

    public function index()
    {
        $semester_model = new SemesterModel();
        $data = [
            'data_semester' => $semester_model->allData(),
            'title' => 'Manajemen Data Periode Semester',
            'content' => 'admin/semester/v_index',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function formtambah()
    {
        $data = [

            'title' => 'Form Tambah Data Semester',
            'content' => 'admin/semester/v_tambah',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        $kode_semester = $this->request->getVar('kode_semester');
        $nama_semester = $this->request->getVar('nama_semester');
        $mulai_semester = $this->request->getVar('mulai_semester');
        $akhir_semester = $this->request->getVar('akhir_semester');

        $rules = $this->validate([
            'kode_semester' => [
                'label' => 'Kode Semester',
                'rules' => 'required|is_unique[tbl_semester.kode_semester]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah digunakan, coba code yang lain'
                ]
            ],

            'nama_semester' => [
                'label' => 'Nama Semester',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],

            'mulai_semester' => [
                'label' => 'Mulai Semester',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],

            'akhir_semester' => [
                'label' => 'Akhir Semester',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],


        ]);

        $semester_model = new SemesterModel();
        if (!$rules) {
            $validation = \Config\Services::validation();
            session()->setFlashData([
                'errorKodeSemester' => $validation->getError('kode_semester'),
                'errorNamaSemester' => $validation->getError('nama_semester'),
                'errorMulaiSemester' => $validation->getError('mulai_semester'),
                'errorAkhirSemester' => $validation->getError('akhir_semester'),

            ]);
            return redirect()->back()->withInput();
        } else {
            $semester_model->insert([
                'kode_semester' => $kode_semester,
                'nama_semester' => $nama_semester,
                'mulai_semester' => $mulai_semester,
                'akhir_semester' => $akhir_semester,
            ]);
        }


        session()->setFlashData('pesan', 'Data berhasil disimpan');
        return redirect()->to('/semester/formtambah');
    }

    public function edit($id_semester)
    {
        $data = [
            'id_semester' => $id_semester,
            'nama_semester' => $this->request->getPost('nama_semester'),
            'mulai_semester' => $this->request->getPost('mulai_semester'),
            'akhir_semester' => $this->request->getPost('akhir_semester'),
            'kode_semester' => $this->request->getPost('kode_semester'),
        ];
        $this->SemesterModel->edit_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to(base_url('semester'));
    }

    public function delete($id_semester)
    {
        $data = [
            'id_semester' => $id_semester,
        ];
        $this->SemesterModel->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil Hapus');
        return redirect()->to(base_url('semester'));
    }



}

