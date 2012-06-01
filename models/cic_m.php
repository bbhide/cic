<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a cic module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	CIC Module
 */
class Cic_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the cic module's table was named "cics"
		 * then MY_Model would find it automatically. Since
		 * I named it "cic" then we just set the name here.
		 */
		$this->_table = 'cic';
	}
	
	//create a new item
	public function create($input)
	{
		$to_insert = $this->_prep_format($input);

		return $this->db->insert($this->_table, $to_insert);
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
		} else {
			$op = $data;
		}

		return $op;
	}

	public function _prep_format($input)
	{
		$to_insert = array(
			'pin'		=> $input['pin'],
			'cic_type'	=> $input['cic_type'],
			'c_name'	=> ucwords( strtolower(	$input['c_name']	 )	),
			'comp_email'=> $input['comp_email'],
			'title'		=> ucwords( strtolower(	$input['title']		 )	),
			'fname'		=> ucwords( strtolower(	$input['fname']		 )	),
			'mname'		=> ucwords( strtolower(	$input['mname']		 )	),
			'lname'		=> ucwords( strtolower(	$input['lname']		 )	),
			'mailing'	=> ucwords( strtolower(	$input['mailing']	 )	),
			'city'		=> ucwords( strtolower(	$input['city']		 )	),
			'country'	=> ucwords( strtolower(	$input['country']	 )	),
			'state'		=> ucwords( strtolower(	$input['state']		 )	),
			'pincode'	=> $input['pincode'],
			'email'		=> $input['email'],
			'mobile'	=> $input['mobile'],
			'c_code'	=> $input['c_code'],
			'phone'		=> $input['phone'],
			'cp_same'	=> isset($input['cp_same'])?1:0,
			'cp'		=> $this->_save_array($input['cp']),
			'author_id'	=> $this->current_user->id
		);
		return $to_insert;
	}
}
