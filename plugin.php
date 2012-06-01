<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a cic module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	CIC Module
 */
class Plugin_CIC extends Plugin
{
	/**
	 * Item List
	 * Usage:
	 * 
	 * {{ cic:items limit="5" order="asc" }}
	 *      {{ id }} {{ name }} {{ slug }}
	 * {{ /cic:items }}
	 *
	 * @return	array
	 */
	function items()
	{
		$limit = $this->attribute('limit');
		$order = $this->attribute('order');
		
		return $this->db->order_by('name', $order)
						->limit($limit)
						->get('cic_items')
						->result_array();
	}
}

/* End of file plugin.php */