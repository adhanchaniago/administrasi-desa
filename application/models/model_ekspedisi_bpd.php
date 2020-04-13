<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_ekspedisi_bpd extends CI_Model {
    public function get_data($id = null)
    {
        if ($id == null) {
            $this->db->order_by('id_ekspedisi_bpd','DESC');
            return $this->db->get('ekspedisi_bpd')->result();
        }else{
            return $this->db->get_where('ekspedisi_bpd',array('id_ekspedisi_bpd'=>$id))->row();
        }
    }
    public function insert_data()
    {
        $data = [
            'tanggal_pengiriman'	 => $this->input->post('tanggal_pengiriman',true),
			'tanggal_surat'	         => $this->input->post('tanggal_surat',true),
			'no_surat'	             => $this->input->post('nomor_surat',true),
			'isi_singkat'	         => $this->input->post('isi_singkat',true),
			'tujuan'	             => $this->input->post('tujuan',true),
			'keterangan'	         => $this->input->post('keterangan',true),
			'file_dokumen' 		     => $this->_upload()
        ];
        //insert data pindahan
        $this->db->insert('ekspedisi_bpd',$data);
		$this->session->set_flashdata('pesan','Akun berhasil dibuat');
        redirect('ekspedisi_bpd');
    }
    public function edit_data()
    {
        //validasi upload foto apakah user update foto atau tidak
        // if (!empty($_FILES["dokumen"]["name"])) {
        //     $data_file = $this->_upload();
        //     //hapus file difolder
        //     unlink('upload/'.$this->input->post('file'));
        // } else {
        //     $data_file = $this->input->post('file');
        // }
        $data = [
            'tanggal_pengiriman'	 => $this->input->post('tanggal_pengiriman',true),
			'tanggal_surat'	         => $this->input->post('tanggal_surat',true),
			'no_surat'	             => $this->input->post('nomor_surat',true),
			'isi_singkat'	         => $this->input->post('isi_singkat',true),
			'tujuan'	             => $this->input->post('tujuan',true),
			'keterangan'	         => $this->input->post('keterangan',true),
			// 'file_dokumen' 		     => $data_file
        ];
        
        $this->db->where('id_ekspedisi_bpd',$this->input->post('id'));
		$this->db->update('ekspedisi_bpd',$data);
		$this->session->set_flashdata('pesan','Akun berhasil diubah');
        redirect('ekspedisi_bpd');
    }
    public function delete_data($id)
    {
        $this->db->where('id_ekspedisi_bpd',$id);
        $this->db->delete('ekspedisi_bpd');
        $this->session->set_flashdata('pesan','Akun berhasil hapus');
        redirect('ekspedisi_bpd');
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