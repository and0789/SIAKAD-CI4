<?php

namespace App\Controllers;

use App\Models\ModelDosen;
use Hermawan\DataTables\DataTable;

class Dosen extends BaseController
{
    public function index()
    {
        return view('dosen/view_data');
    }

    public function getData()
    {
        if ($this->request->isAJAX()) {
            $db = db_connect();
            $builder = $db->table('dosen')
                ->select('kode_dosen, nama_dosen, alamat_dosen, jk_dosen, telp_dosen');

            return DataTable::of($builder)
                ->addNumbering()
                ->add('action', function ($row) {
                    return
                        '<button type="button" 
                                class="btn btn-sm btn-danger"   
                                title="Hapus Data" 
                                onclick="hapusData(\'' . $row->kode_dosen . '\',\'' . $row->nama_dosen . '\')">
                            <i class="fas fa-trash-alt"></i>
                        </button> &nbsp 
                        <button type="button" 
                                class="btn btn-sm btn-info"   
                                title="Edit Data" 
                                onclick="editData(\'' . $row->kode_dosen . '\')">
                            <i class="fas fa-edit"></i>
                        </button>';
                }, 'last')
                ->toJson();
        }
    }

    public function formTambah()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('dosen/view_tambahData')
            ];
            echo json_encode($json);
        }
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $kode_dosen = $this->request->getPost('kode_dosen');
            $nama_dosen = $this->request->getPost('nama_dosen');
            $alamat_dosen = $this->request->getPost('alamat_dosen');
            $jk_dosen = $this->request->getPost('jk_dosen');
            $telp_dosen = $this->request->getPost('telp_dosen');

            $rules = $this->validate([

                'kode_dosen' => [
                    'label' => 'Kode Dosen',
                    'rules' => 'required|is_unique[dosen.kode_dosen]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah ada',
                    ]
                ],

                'nama_dosen' => [
                    'label' => 'Nama Dosen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'alamat_dosen' => [
                    'label' => 'Alamat Dosen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'jk_dosen' => [
                    'label' => 'Jenis Kelamin Dosen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'telp_dosen' => [
                    'label' => 'No Telephone/HP Dosen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);

            if (!$rules) {
                $validation = \Config\Services::validation();

                $error = [
                    'error_kodeDosen' => $validation->getError('kode_dosen'),
                    'error_namaDosen' => $validation->getError('nama_dosen'),
                    'error_alamatDosen' => $validation->getError('alamat_dosen'),
                    'error_jkDosen' => $validation->getError('jk_dosen'),
                    'error_telpDosen' => $validation->getError('telp_dosen'),
                ];

                $json = [
                    'error' => $error
                ];

            } else {
                $model_dosen = new ModelDosen();
                $model_dosen->insert([
                    'kode_dosen' => $kode_dosen,
                    'nama_dosen' => $nama_dosen,
                    'alamat_dosen' => $alamat_dosen,
                    'jk_dosen' => $jk_dosen,
                    'telp_dosen' => $telp_dosen,
                ]);

                $json = [
                    'success' => ' Data Dosen berhasil disimpan'
                ];
            }
            echo json_encode($json);
        }
    }

    public function delete($kode = null)
    {
        if ($this->request->isAJAX()) {
            $model_dosen = new ModelDosen();
            $cek_data = $model_dosen->find($kode);

            if ($cek_data) {
                $model_dosen->delete($kode);
                $json = [
                    'success' => 'Data Dosen berhasil dihapus'
                ];

                echo json_encode($json);
            }
        }
    }

    public function formEdit($kode = null)
    {
        if ($this->request->isAJAX()) {
            $model_dosen = new ModelDosen();
            $cek_data = $model_dosen->find($kode);

            if ($cek_data) {
                $data = [
                    'kode_dosen' => $kode,
                    'nama_dosen' => $cek_data['nama_dosen'],
                    'alamat_dosen' => $cek_data['alamat_dosen'],
                    'jk_dosen' => $cek_data['jk_dosen'],
                    'telp_dosen' => $cek_data['telp_dosen'],
                ];
                $json = [
                    'data' => view('dosen/view_formEdit', $data)
                ];

                echo json_encode($json);
            }
        }
    }

    function updateData()
    {
        if ($this->request->isAJAX()) {
            $kode_dosen = $this->request->getPost('kode_dosen');
            $nama_dosen = $this->request->getPost('nama_dosen');
            $alamat_dosen = $this->request->getPost('alamat_dosen');
            $jk_dosen = $this->request->getPost('jk_dosen');
            $telp_dosen = $this->request->getPost('telp_dosen');

            $rules = $this->validate([

                'nama_dosen' => [
                    'rules' => 'required',
                    'label' => 'Nama Dosen',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'alamat_dosen' => [
                    'rules' => 'required',
                    'label' => 'Alamat Dosen',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'jk_dosen' => [
                    'rules' => 'required',
                    'label' => 'Jenis Kelamin Dosen',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'telp_dosen' => [
                    'rules' => 'required|numeric',
                    'label' => 'Telephone/HP Dosen',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} harus angka'
                    ]
                ],
            ]);

            if (!$rules) {
                $validation = \Config\Services::validation();

                $error = [

                    'error_namaDosen' => $validation->getError('nama_dosen'),
                    'error_alamatDosen' => $validation->getError('alamat_dosen'),
                    'error_jkDosen' => $validation->getError('jk_dosen'),
                    'error_telpDosen' => $validation->getError('telp_dosen')
                ];

                $json = [
                    'error' => $error
                ];
            } else {
                $model_dosen = new ModelDosen();
                $model_dosen->update($kode_dosen,[
                    'nama_dosen' => $nama_dosen,
                    'alamat_dosen' => $alamat_dosen,
                    'jk_dosen' => $jk_dosen,
                    'telp_dosen' => $telp_dosen
                ]);

                $json = [
                    'success' => 'Data dosen dengan nama '.$nama_dosen.' berhasil diupdate'
                ];
            }

            echo json_encode($json);
        }
    }
}