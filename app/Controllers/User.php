<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->UserModel = new UserModel();

    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => $this->UserModel->allData(),
            'content' => 'admin/v_user',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],

            'username' => [
                'label' => 'username',
                'rules' => 'required|is_unique[tbl_ruangan.ruangan]',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'is_unique' => 'Nama {field} sudah ada, silahkan tambahkan yang lain'
                ]
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],

            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi',
                    'max_size' => '{field} maksimal 1024Kb',
                    'mime_in' => '{field} wajib png atau jpg',
                ]
            ],
        ])) {
            // jika valid
            // Ambil foto dari input
            $foto = $this->request->getFile('foto');

            // merename nama file
            $nama_file = $foto->getRandomName();

            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'foto' => $nama_file,
            ];
            // upload file ke server
            $foto->move('photo', $nama_file);
            $this->UserModel->add($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('user'));

        } else {
            // jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user'));
        }
    }


    public function edit($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],

            'username' => [
                'label' => 'username',
                'rules' => 'required|is_unique[tbl_ruangan.ruangan]',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'is_unique' => 'Nama {field} sudah ada, silahkan tambahkan yang lain'
                ]
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],

            'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => '{field} maksimal 1024Kb',
                    'mime_in' => '{field} wajib png atau jpg',
                ]
            ],
        ])) {

            // jika valid
            // Ambil foto dari input
            $foto = $this->request->getFile('foto');

            if ($foto->getError() == 4) {
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),

                ];
                $this->UserModel->edit($data);
            } else {
                // Menghapus foto lama,
                $user = $this->UserModel->detail_data($id_user);
                if ($user['foto'] != "") {
                    unlink('photo/' . $user['foto']);
                }

                $nama_file = $foto->getRandomName();
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'foto' => $nama_file,
                ];
                // upload file ke server
                $foto->move('photo', $nama_file);
                $this->UserModel->edit($data);

            }
            session()->setFlashdata('pesan', 'Data Berhasil Diedit');
            return redirect()->to(base_url('user'));

        } else {
            // jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user'));
        }
    }

    public function delete($id_user)
    {
        // Menghapus foto lama,
        $user = $this->UserModel->detail_data($id_user);
        if ($user['foto'] != "") {
            unlink('photo/' . $user['foto']);
        }

        $data = [
            'id_user' => $id_user,
        ];
        $this->UserModel->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil Hapus');
        return redirect()->to(base_url('user'));
    }
}
