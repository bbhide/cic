<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	public function save_array($data)
	{
		$op = "";

		if(!empty($data) && is_array($data)){
			$op = implode(',', $data);
		} else {
			$op = $data;
		}

		return $op;
	}

	public function retrive_array($data)
	{
		$op = "";

		if(!strlen($data)){
			$op = explode(',', $data);
		} else {
			$op = $data;
		}

		return $op;
	}