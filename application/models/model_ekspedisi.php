<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_ekspedisi extends CI_Model {
    public function get_data($id = null)
    {
        if ($id == null) {
            $this->db->order_by('id_ekspedisi','DESC');
            return $this->db->get('ekspedisi')->result();
        }else{
            return $this->db->get_where('ekspedisi',array('id_ekspedisi'=>$id))->row();
        }
    }
    public function insert_data()
    {
        $tanggal_surat =  str_replace('/', '-',$this->input->post('tanggal_surat',true));
        $tanggal_pengiriman =  str_replace('/', '-',$this->input->post('tanggal_pengiriman',true));
        $data = [
            'tujuan'	             => $this->input->post('tujuan',true),
            'keterangan'	         => $this->input->post('keterangan',true),
            'nomor_surat'	         => $this->input->post('nomor_surat',true),
            'isi_singkat'	         => $this->input->post('isi_singkat',true),
            'tanggal_surat'	         => date('Y-m-d', strtotime($tanggal_surat)),
            'tanggal_pengiriman'	 => date('Y-m-d', strtotime($tanggal_pengiriman)),
			'file_dokumen' 		     => $this->_upload()
        ];
        //insert data pindahan
        $this->db->insert('ekspedisi',$data);
        //nontifikasi
        date_default_timezone_set("Asia/Jakarta");
        $data_notifikasi = [
            'keterangan' => 'menambah data ekspedisi',
            'url'        => 'ekspedisi',
            'waktu'        => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('notifikasi',$data_notifikasi);
		$this->session->set_flashdata('pesan','Akun berhasil dibuat');
        redirect('ekspedisi');
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
        $tanggal_surat =  str_replace('/', '-',$this->input->post('tanggal_surat',true));
        $tanggal_pengiriman =  str_replace('/', '-',$this->input->post('tanggal_pengiriman',true));
        $data = [
            'tujuan'	             => $this->input->post('tujuan',true),
            'keterangan'	         => $this->input->post('keterangan',true),
            'nomor_surat'	         => $this->input->post('nomor_surat',true),
            'isi_singkat'	         => $this->input->post('isi_singkat',true),
            'tanggal_surat'	         => date('Y-m-d', strtotime($tanggal_surat)),
            'tanggal_pengiriman'	 => date('Y-m-d', strtotime($tanggal_pengiriman)),
			'file_dokumen' 		     => $data_file
        ];
        
        $this->db->where('id_ekspedisi',$this->input->post('id'));
		$this->db->update('ekspedisi',$data);
        //nontifikasi
        date_default_timezone_set("Asia/Jakarta");
        $data_notifikasi = [
            'keterangan' => 'edit data ekspedisi',
            'url'        => 'ekspedisi',
            'waktu'        => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('notifikasi',$data_notifikasi);
		$this->session->set_flashdata('pesan','Akun berhasil diubah');
        redirect('ekspedisi');
    }
    public function delete_data($id)
    {
        $this->db->where('id_ekspedisi',$id);
        $this->db->delete('ekspedisi');
        //nontifikasi
        date_default_timezone_set("Asia/Jakarta");
        $data_notifikasi = [
            'keterangan' => 'hapus data ekspedisi',
            'url'        => 'ekspedisi',
            'waktu'        => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('notifikasi',$data_notifikasi);
        $this->session->set_flashdata('pesan','Akun berhasil hapus');
        redirect('ekspedisi');
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
