<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris_proyek extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_inventaris_proyek');
	}
	public function index()
	{
		//load view pake library template
		$data['inventaris_proyek'] = $this->model_inventaris_proyek->get_data();
		$this->template->load('template_admin','inventaris_proyek/data_inventaris_proyek',$data);
		
	}
	public function add_inventaris_proyek()
	{
		//form validation
        $this->form_validation->set_rules('nama_proyek', 'nama_lengkap', 'trim|required');
        $this->form_validation->set_rules('volume', 'nama_lengkap', 'trim|required');
        $this->form_validation->set_rules('lokasi', 'nama_lengkap', 'trim|required');
        $this->form_validation->set_rules('biaya', 'nama_lengkap', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'nama_lengkap', 'trim|required');
		if ($this->form_validation->run() == true) {
			$this->model_inventaris_proyek->insert_data();
		}
        $this->template->load('template_admin','inventaris_proyek/add_inventaris_proyek');
	}
	public function edit_inventaris_proyek($id)
	{
		//form validation
        $this->form_validation->set_rules('nama_proyek', 'nama_lengkap', 'trim|required');
        $this->form_validation->set_rules('volume', 'nama_lengkap', 'trim|required');
        $this->form_validation->set_rules('lokasi', 'nama_lengkap', 'trim|required');
        $this->form_validation->set_rules('biaya', 'nama_lengkap', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'nama_lengkap', 'trim|required');
		if ($this->form_validation->run() == true) {
			$this->model_inventaris_proyek->edit_data();
		}
		$data['inventaris_proyek'] = $this->model_inventaris_proyek->get_data($id);
		$this->template->load('template_admin','inventaris_proyek/edit_inventaris_proyek',$data);

	}
	public function delete_inventaris_proyek($id)
	{
		$this->model_inventaris_proyek->delete_data($id);
	}
}