<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_perdes extends CI_Model {
    public function get_data($id = null)
    {
        if ($id == null) {
            $this->db->order_by('id_peraturan_desa','DESC');
            return $this->db->get('peraturan_desa')->result();
        }else{
            return $this->db->get_where('peraturan_desa',array('id_peraturan_desa'=>$id))->row();
        }
    }
    public function insert_data()
    {
        $tanggal_peraturan_desa  =  str_replace('/', '-',$this->input->post('tanggal_perdes',true));
        $tanggal_dilaporkan      =  str_replace('/', '-',$this->input->post('tanggal_dilaporkan',true));
        $tanggal_persetujuan_BPD =  str_replace('/', '-',$this->input->post('tanggal_persetujuan_bpd',true));
        $data = [
            'uraian_singkat'	     => $this->input->post('uraian',true),
			'tentang'	             => $this->input->post('tentang',true),
			'keterangan'	         => $this->input->post('keterangan',true),
			'nomor_peraturan_desa'	 => $this->input->post('nomor_perdes',true),
			'tanggal_peraturan_desa' => date('Y-m-d', strtotime($tanggal_peraturan_desa)),
			'nomor_dilaporkan'	     => $this->input->post('nomor_laporkan',true),
			'tanggal_dilaporkan'	 => date('Y-m-d', strtotime($tanggal_dilaporkan)),
			'nomor_persetujuan_BPD'	 => $this->input->post('nomor_persetujuan_bpd',true),
			'tanggal_persetujuan_BPD'=> date('Y-m-d', strtotime($tanggal_persetujuan_BPD)),
			'file_dokumen' 		     => $this->_upload()
        ];
        //insert data pindahan
        $this->db->insert('peraturan_desa',$data);
        //nontifikasi
        date_default_timezone_set("Asia/Jakarta");
        $data_notifikasi = [
            'keterangan' => 'menambah data perdes',
            'url'        => 'perdes',
            'waktu'        => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('notifikasi',$data_notifikasi);
		$this->session->set_flashdata('pesan','Akun berhasil dibuat');
        redirect('perdes');
    }
    public function edit_data()
    {
        //validasi upload foto apakah user update foto atau tidak
        if (!empty($_FILES["dokumen"]["name"])) {
            $data_file = $this->_upload();
            //hapus file difolder
            unlink('upload/'.$this->input->post('file'));
        } else {
            $data_file = $this->input->post('file');
        }
        $tanggal_peraturan_desa  =  str_replace('/', '-',$this->input->post('tanggal_perdes',true));
        $tanggal_dilaporkan      =  str_replace('/', '-',$this->input->post('tanggal_dilaporkan',true));
        $tanggal_persetujuan_BPD =  str_replace('/', '-',$this->input->post('tanggal_persetujuan_bpd',true));
        $data = [
            'uraian_singkat'	     => $this->input->post('uraian',true),
			'tentang'	             => $this->input->post('tentang',true),
			'keterangan'	         => $this->input->post('keterangan',true),
			'nomor_peraturan_desa'	 => $this->input->post('nomor_perdes',true),
			'tanggal_peraturan_desa' => date('Y-m-d', strtotime($tanggal_peraturan_desa)),
			'nomor_dilaporkan'	     => $this->input->post('nomor_laporkan',true),
			'tanggal_dilaporkan'	 => date('Y-m-d', strtotime($tanggal_dilaporkan)),
			'nomor_persetujuan_BPD'	 => $this->input->post('nomor_persetujuan_bpd',true),
			'tanggal_persetujuan_BPD'=> date('Y-m-d', strtotime($tanggal_persetujuan_BPD)),
			'file_dokumen' 		     => $data_file
        ];
        
        $this->db->where('id_peraturan_desa',$this->input->post('id'));
		$this->db->update('peraturan_desa',$data);
        //nontifikasi
        date_default_timezone_set("Asia/Jakarta");
        $data_notifikasi = [
            'keterangan' => 'edit data perdes',
            'url'        => 'perdes',
            'waktu'        => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('notifikasi',$data_notifikasi);
		$this->session->set_flashdata('pesan','Akun berhasil diubah');
        redirect('perdes');
    }
    public function delete_data($id)
    {
        $this->db->where('id_peraturan_desa',$id);
        $this->db->delete('peraturan_desa');
        //nontifikasi
        date_default_timezone_set("Asia/Jakarta");
        $data_notifikasi = [
            'keterangan' => 'hapus data perdes',
            'url'        => 'perdes',
            'waktu'        => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('notifikasi',$data_notifikasi);
        $this->session->set_flashdata('pesan','Akun berhasil hapus');
        redirect('perdes');
    }
    private function _upload(){
        //upload foto
		$config['upload_path']          = './upload/';
		$config['allowed_types']        = 'jpg|png|doc|pdf';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
        $config['max_height']           = 768;
        //load library
		$this->load->library('upload', $config);
		// validasi upload foto 
		if ($this->upload->do_upload('dokumen')) {
            return $this->upload->data("file_name");
        }
        
        return "avatar.jpg";
        
    } 
}
