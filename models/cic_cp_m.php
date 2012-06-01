<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a cp module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @package 	Contact Person Model
 * @subpackage 	Contact Person Module
 */
class Cic_cp_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the cp module's table was named "cps"
		 * then MY_Model would find it automatically. Since
		 * I named it "cp" then we just set the name here.
		 */
		$this->_table = 'cic_cp';
	}
	
	//create a new item
	public function create($input)
	{
		$to_insert = $this->_prep_format($input);

		return $this->db->insert($this->_table, $to_insert);
	}

	public function create_ajax($input)
	{
		$to_insert = $this->_prep_format($input);

		if($this->db->insert($this->_table, $to_insert)){
			return $this->db->insert_id();
		} else {
			return false;
		} 
	}

	public function edit($id,$input)
	{
		$to_update = $this->_prep_format($input);
		$this->db->where('id', $id);
		return $this->db->update($this->_table, $to_update);
	}

	//make sure the slug is valid
	public function _save_array($data)
	{
		$op = array();

		if(!empty($data)){
			if(is_array($data )){
				foreach($data as $val){
					if(!empty($val)){
						$op[] = $val;
					}
				}
				$op = implode(',', $op);
			}
		}

		return $op;
	}

	public function _retrive_array($data)
	{
		$op = "";

		if(!strlen($data)){
			$op = explode(',', $data);
		}

		return $op;
	}

	public function _prep_format($input)
	{
		$to_insert = array(
			'title'		=> $input['title'],
			'fname'		=> ucwords(	strtolower(	$input['fname']	)),
			'mname'		=> ucwords(	strtolower(	$input['mname']	)),
			'lname'		=> ucwords(	strtolower(	$input['lname']	)),
			'email'		=> $this->_save_array($input['email']),
			'mobile'	=> $this->_save_array($input['mobile']),
			'author_id'	=> $this->current_user->id
		);
		return $to_insert;
	}
}
