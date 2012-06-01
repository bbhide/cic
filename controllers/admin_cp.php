<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Cp extends Admin_Controller
{
	protected $section = 'cpersons';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cic_cp_m');
		$this->load->library('form_validation');
		$this->lang->load('cic');

		$this->data->array_for_title = array(
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
				'field' => 'title',
				'label' => lang('cic:title'),
				'rules' => 'trim'
			),
			array(
				'field' => 'email',
				'label' => lang('cic:email'),
			),
			array(
				'field' => 'mobile',
				'label' => lang('cic:mobile'),
			)
		);
		$this->data->email	= array();
		$this->data->mobile = array();

		// We'll set the partials and metadata here since they're used everywhere
		$this->template->append_js('module::admin.js')->append_css('module::admin.css');
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
		// Build the view using cic/views/admin/form.php
		$this->template->title($this->module_details['name'], lang('cic.new_item'))
						->build('admin/cp/form', $this->data);
	}

	public function create_ajax()
	{
		// Loop through each validation rule
		
		$this->data->method = 'create';
		$this->data->cp =& $cp;

		$this->form_validation->set_rules($this->cp_validation_rules);
		

		if ($this->form_validation->run())
		{
			$id = $this->cic_cp_m->create_ajax($this->input->post());
			
			if ($id > 0)
			{
				$message = sprintf( lang('cic:success'), $this->input->post('fname'));
			}
			else
			{
				$message = lang('cic:error');
			}

			return $this->template->build_json(array(
				'message'		=> $message,
				'title'			=> $this->input->post('fname').' '.$this->input->post('mname').' '.$this->input->post('lname').' - '.implode(',', $this->input->post('email')),
				'cp'			=> $id,
				'status'		=> 'ok'
			));
		}	
		else
		{
			// Render the view
			foreach ($this->cp_validation_rules AS $rule)
			{
				$this->data->{$rule['field']} = $this->input->post($rule['field']);
			}
			$form = $this->load->view('admin/cp/form', $this->data, TRUE);

			if ($errors = validation_errors())
			{
				return $this->template->build_json(array(
					'message'	=> $errors,
					'status'	=> 'error',
					'form'		=> $form
				));
			}

			echo $form;
		}
	}

	public function edit($id = 0)
	{

		$cp = $this->cic_cp_m->get($id);

		foreach ($this->cp_validation_rules as $rule)
		{
			$this->data->{$rule['field']} = $cp->{$rule['field']};
		}

		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->cp_validation_rules);

		// check if the form validation passed
		if($this->form_validation->run())
		{
			// get rid of the btnAction item that tells us which button was clicked.
			// If we don't unset it MY_Model will try to insert it
			unset($_POST['btnAction']);
			
			// See if the model can create the record
			if($this->cic_cp_m->edit($id, $this->input->post()))
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
		foreach ($this->cp_validation_rules AS $rule)
		{
			$this->data->{$rule['field']} = $cp->{$rule['field']};
		}

		//echo "<pre>";print_r($this->data); echo "<pre>";die;

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