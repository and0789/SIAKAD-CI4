<?php

namespace App\Models;

use CodeIgniter\Model;

class SemesterModel extends Model
{

    protected $table            = 'tbl_semester';
    protected $primaryKey       = 'id_semester';
    protected $allowedFields    = ['id_semester', 'nama_semester', 'mulai_semester', 'akhir_semester', 'aktif_semester', 'kode_semester'];

    public function allData()
    {
        return $this->db->table('tbl_semester')
            ->orderBy('id_semester', 'DESC')
            ->get()->getResultArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_semester')->insert($data);
    }

    public function edit_data($data)
    {
        $this->db->table('tbl_semester')
            ->where('id_semester', $data['id_semester'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tbl_semester')
            ->where('id_semester', $data['id_semester'])
            ->delete($data);
    }


}
