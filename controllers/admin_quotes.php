<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Quotes extends Admin_Controller
{
	protected $section = 'cpquotes';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cic_cp_m');
		$this->load->library('form_validation');
		$this->lang->load('cic');

		$this->data->title = array(
		'0'	=> '',
		'1'	=>  'Mr.',
		'2'	=> 'Ms.',
		'3'	=> 'Mrs',
		'4'	=> 'Dr.',
		'5'	=> 'M/s' );
		
		$this->cp_validation_rules = array(
			array(
				'field' => 'fname',
				'label' => lang('cic:fname'),
				'rules' => 'trim|max_length[100]'
			),
			array(
				'field' => 'mname',
				'label' => lang('cic:mname'),
				'rules' => 'trim|max_length[100]'
			),
			array(
				'field' => 'lname',
				'label' => lang('cic:lname'),
				'rules' => 'trim|max_length[100]'
			),

			array(
				'field' => 'mailing',
				'label' => lang('cic:mailing'),
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'city',
				'label' => lang('cic:city'),
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'country',
				'label' => lang('cic:country'),
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'state',
				'label' => lang('cic:state'),
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'pincode',
				'label' => lang('cic:pincode'),
				'rules' => 'trim|max_length[100]|required'
			)
		);
		// We'll set the partials and metadata here since they're used everywhere
		//$this->template->append_js('module::admin.js')->append_css('module::admin.css');
	}

	/**
	 * List all items
	 */
	public function index()
	{
		// here we use MY_Model's get_all() method to fetch everything
		$items = $this->cic_cp_m->get_all();
		//$items = array( );

		// Build the view with cic/views/admin/items.php
		$this->data->items =& $items;
		$this->template->title($this->module_details['name'])
						->build('admin/cp/list', $this->data);
	}

	public function create()
	{
		$emails = array();
		$phones = array();
		$cppin = "";
		
		$this->template->set('emails', $emails);
		$this->template->set('phones', $phones);
		$this->template->set('cppin', $cppin);
		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->cp_validation_rules);

		// check if the form validation passed
		if($this->form_validation->run())
		{
			// See if the model can create the record
			if($this->cic_cp_m->create($this->input->post()))
			{
				// All good...
				$this->session->set_flashdata('success', lang('cic.success'));
				redirect('admin/cic/cp/');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('cic.error'));
				foreach ($this->input->post('email') as $email) {
					$emails[] = $email;
				}
				redirect('admin/cic/cp/create');
			}
		}
		
		foreach ($this->cp_validation_rules AS $rule)
		{
			$this->data->{$rule['field']} = $this->input->post($rule['field']);
		}

		 $this->data->emails = $emails;
		// Build the view using cic/views/admin/form.php
		$this->template->title($this->module_details['name'], lang('cic.new_item'))
						->build('admin/cp/form', $this->data);
	}

	public function edit($id = 0)
	{
		$emails = array();
		$phones = array();
		$cps = array();
		$mobiles = array();
		
		$this->template->set('email', $emails);
		$this->template->set('phone', $phones);
		$this->template->set('cp', $cps);
		$this->template->set('mobile', $mobiles);
		$this->data = $this->cic_cp_m->get($id);

		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->cp_validation_rules);

		// check if the form validation passed
		if($this->form_validation->run())
		{
			// get rid of the btnAction item that tells us which button was clicked.
			// If we don't unset it MY_Model will try to insert it
			unset($_POST['btnAction']);
			
			// See if the model can create the record
			if($this->cic_cp_m->update($id, $this->input->post()))
			{
				// All good...
				$this->session->set_flashdata('success', lang('cic.success'));
				redirect('admin/cic/cp');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('cic.error'));
				redirect('admin/cic/cp/create');
			}
		}

		// Build the view using cic/views/admin/form.php
		$this->template->title($this->module_details['name'], lang('cic.edit'))
						->build('admin/cp/form', $this->data);
	}

	public function delete($id = 0)
	{
		// make sure the button was clicked and that there is an array of ids
		if (isset($_POST['btnAction']) AND is_array($_POST['action_to'])){
			// pass the ids and let MY_Model delete the items
			$this->cic_cp_m->delete_many($this->input->post('action_to'));
		} elseif (is_numeric($id))	{
			// they just clicked the link so we'll delete that one
			$this->cic_cp_m->delete($id);
		}
		redirect('admin/cic/cp');
	}

	public function ajax()
	{

	}

}