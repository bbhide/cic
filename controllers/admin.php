<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a cic module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	CIC Module
 */
class Admin extends Admin_Controller
{
	protected $section = 'items';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('cic_m');
		$this->load->library('form_validation');
		$this->lang->load('cic');

		// Set the validation rules
		$this->company_validation_rules = array(
			array(
				'field' => 'c_name',
				'label' => lang('cic:c_name'),
				'rules' => 'trim|max_length[100]'
			),array(
				'field' => 'comp_email',
				'label' => lang('cic:title'),
				'rules' => 'trim'
			),array(
				'field' => 'title',
				'label' => lang('cic:title'),
				'rules' => 'trim'
			),array(
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
				'field' => 'cic_type',
				'label' => lang('cic:type'),
				'rules' => 'trim'
			),
			array(
				'field' => 'pin',
				'label' => lang('cic:pin'),
				'rules' => 'trim|max_length[100]|required'
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
			),
			array(
				'field' => 'mobile',
				'label' => lang('cic:mobile'),
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'email',
				'label' => lang('cic:email'),
				'rules' => 'trim|max_length[100]|required|email'
			),
			array(
				'field' => 'c_code',
				'label' => lang('cic:c_code'),
				'rules' => 'trim|max_length[3]'
			),
			array(
				'field' => 'phone',
				'label' => lang('cic:phone'),
				'rules' => 'trim|max_length[10]|numeric'
			),
			array(
				'field' => 'cp_same',
				'label' => 'Same As above',
				'rules' => 'trim|numeric'
			),
			array(
				'field' => 'cp',
				'label' => 'CP'
			)
		);

		$this->data->array_for_title = array(
		'0'	=> '',
		'1'	=>  'Mr.',
		'2'	=> 'Ms.',
		'3'	=> 'Mrs',
		'4'	=> 'Dr.',
		'5'	=> 'M/s' 
		);

		$this->data->array_for_ctype = array(
		'2'  => 'Company',
		'1'  => 'Individual'
		);
		$this->data->type = array();

		$this->load->model('cic_cp_m');
		$this->data->contactpersons = $this->cic_cp_m->get_all();
		//echo "<pre>";print_r($this->data->contactpersons);echo "</pre>";die;
		foreach ($this->data->contactpersons as $cp) {
			//echo "<pre>";print_r($cp);echo "</pre>";die;
			$this->data->array_for_cp->{$cp->id} = $cp->fname ." ". $cp->mname ." ". $cp->lname ." - ".$cp->email;
		}

		// We'll set the partials and metadata here since they're used everywhere
		$this->template->append_js('module::admin.js')
						->append_css('module::admin.css');
	}

	/**
	 * List all items
	 */
	public function index()
	{
		// here we use MY_Model's get_all() method to fetch everything
		$items = $this->cic_m->get_all();

		// Build the view with cic/views/admin/items.php
		$this->data->items =& $items;
		$this->template->title($this->module_details['name'])
						->build('admin/items', $this->data);
	}

	public function view_ajax($id = null)
	{
		// Loop through each validation rule
		
		$this->data->method = 'view';
		$this->data->cp =& $cp;

		$this->form_validation->set_rules($this->cp_validation_rules);
		

		if ($id>0)
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

	public function create()
	{
		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->company_validation_rules);

		// check if the form validation passed
		if($this->form_validation->run())
		{
			// See if the model can create the record
			if($this->cic_m->create($this->input->post()))
			{
				// All good...
				$this->session->set_flashdata('success', lang('cic.success'));
				redirect('admin/cic');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('cic.error'));
				redirect('admin/cic/create');
			}
		}
		
		foreach ($this->company_validation_rules AS $rule)
		{
			$this->data->{$rule['field']} = $this->input->post($rule['field']);
		}

		// Build the view using cic/views/admin/form.php
		$this->template->title($this->module_details['name'], lang('cic.new_item'))
						->build('admin/form', $this->data);
	}
	
	public function edit($id = 0)
	{
		$cic = $this->cic_m->get($id);
		$cic->cp = explode(',', $cic->cp);

		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->company_validation_rules);

		//echo "<pre>";print_r($this->company_validation_rules); echo "<pre>";die;

		// check if the form validation passed
		if($this->form_validation->run())
		{
			// get rid of the btnAction item that tells us which button was clicked.
			// If we don't unset it MY_Model will try to insert it
			unset($_POST['btnAction']);
			
			// See if the model can create the record
			
			if($this->cic_m->edit( $id, $this->input->post() ))
			{
				// All good...
				$this->session->set_flashdata('success', lang('cic.success'));
				redirect('admin/cic');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('cic.error'));
				redirect('admin/cic/create');
			}
		}

		// Build the view using cic/views/admin/form.php
		
		foreach ($this->company_validation_rules AS $rule)
		{
			$this->data->{$rule['field']} = $cic->{$rule['field']};
		}
		
		//echo "<pre>";print_r($this->data); echo "<pre>";die;

		$this->template->title($this->module_details['name'], lang('cic.edit'))
						->build('admin/form', $this->data);
	}
	
	public function delete($id = 0)
	{
		// make sure the button was clicked and that there is an array of ids
		if (isset($_POST['btnAction']) AND is_array($_POST['action_to'])){
			// pass the ids and let MY_Model delete the items
			$this->cic_m->delete_many($this->input->post('action_to'));
		} elseif (is_numeric($id)) {
			// they just clicked the link so we'll delete that one
			$this->cic_m->delete($id);
		}
		redirect('admin/cic');
	}

}
