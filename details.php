<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_CIC extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Cust Info Center'
			),
			'description' => array(
				'en' => 'Customer Information Center. Manage your customers here.'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'cic', // You can also place modules in their top level menu. For example try: 'menu' => 'CIC',
			

			'sections' => array(
			    'items' => array(
				    'name' => 'cic:items',
				    'uri' => 'admin/cic',
				    'shortcuts' => array(
							'create' => array(
								'name' 	=> 'cic:create',
								'uri' 	=> 'admin/cic/create',
								'class' => 'add'
								)
							)
				),
				'cpersons' => array(
				    'name' => 'cp:list',
				    'uri' => 'admin/cic/cp',
				    'shortcuts' => array(
								'create' => array(
									'name' 	=> 'cp:create',
									'uri' 	=> 'admin/cic/cp/create',
									'class' => 'add'
									)
								)
			    ),
		    ),
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('cic');
		$this->dbforge->drop_table('cic_cp');
		$this->db->delete('settings', array('module' => 'cic'));
/*
		$cic = array(
                        'id' => array(
									  'type' => 'INT',
									  'constraint' => '11',
									  'auto_increment' => TRUE
									  ),
						'name' => array(
										'type' => 'VARCHAR',
										'constraint' => '100'
										),
						'slug' => array(
										'type' => 'VARCHAR',
										'constraint' => '100'
										)
						);
*/
		$cic_sql = 
'
CREATE TABLE IF NOT EXISTS '. $this->db->dbprefix('cic') .' (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cic_type` int(11) NOT NULL,
  `comp_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mailing` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_code` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cp` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `cp_same` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ; ';

$cic_sample_data =
"
INSERT INTO ". $this->db->dbprefix('cic') ." (`id`, `pin`, `cic_type`, `comp_email`, `c_name`, `title`, `fname`, `mname`, `lname`, `mailing`, `city`, `country`, `state`, `pincode`, `email`, `mobile`, `c_code`, `phone`, `cp`, `cp_same`, `author_id`) VALUES
(1, '0001', 2, 'info@eduserve.in', 'Eduserve', '1', 'Mahavir', 'J', 'Deshlehra', 'Aarey Road, Goregaon West', 'Mumbai', 'India', 'Maharashtra', '400062', 'bhavesh.bhide@eduserve.in', '9870772267', '022', '28996800', '1', 0, 1),
(2, '0002', 1, '', '', '1', 'Karan', '', 'More', 'Andheri East', 'Mumbai', 'India', 'Maharashtra', '400092', 'karan.more@eduserve.in', '9870777226', '', '', '2', 0, 1),
(3, '0003', 2, 'info@osianinternational.in', 'Osian', '1', 'Mahavir', 'J', 'Deshlehra', 'Aarey Road, Goregaon West', 'Mumbai', 'India', 'Maharashtra', '400067', 'mahavir@eduserve.in', '9867267282', '022', '28996800', '1,2', 1, 1);
";

$cic_cp_sql =
'
CREATE TABLE IF NOT EXISTS '. $this->db->dbprefix('cic_cp') .' (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `mobile` mediumtext COLLATE utf8_unicode_ci,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;';

$cic_cp_sample_data =
"
INSERT INTO ". $this->db->dbprefix('cic_cp') ." (`id`, `title`, `fname`, `mname`, `lname`, `email`, `mobile`, `author_id`) VALUES
(1, '1', 'Bhavesh', 'Sudhir', 'Bhide', 'bhavesh.bhide@gmail.com,bhavesh.bhide@eduserve.in', '9870772267', 1),
(2, '1', 'Karan', '', 'More', 'karan.nore@eduserve.in', '9029501257', 1),
(3, '1', 'Vishal', 'Ashok', 'Patil', 'vishal.patil@eduserve.in', '', 1),
(4, '1', 'Praveen', '', 'Sharma', 'praveen@eduserve.in', '', 1),
(5, '0', 'Mahavir', '', 'Deshlehra', 'mahavir@eduserve.in', '', 1);";
		$cic_setting = array(
			'slug' => 'cic_setting',
			'title' => 'CIC Setting',
			'description' => 'A Yes or No option for the CIC module',
			'`default`' => '1',
			'`value`' => '1',
			'type' => 'select',
			'`options`' => '1=Yes|0=No',
			'is_required' => 1,
			'is_gui' => 1,
			'module' => 'cic'
		);

		//$this->dbforge->add_field($cic);
		//$this->dbforge->add_key('id', TRUE);

		if($this->db->query($cic_sql) AND
		   $this->db->query($cic_cp_sql) AND
		   //$this->db->insert('settings', $cic_setting) AND
		   is_dir($this->upload_path.'cic') OR @mkdir($this->upload_path.'cic',0777,TRUE))
		{
			$this->db->query($cic_sample_data);
			$this->db->query($cic_cp_sample_data);
			return TRUE;
		}
	}

	public function uninstall()
	{
		$this->dbforge->drop_table('cic');
		$this->dbforge->drop_table('cic_cp');
		//$this->db->delete('settings', array('module' => 'cic'));
		{
			return TRUE;
		}
	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "Create Customers<br />Add Contact persons<br /> All Fields with * are mandatory.";
	}
}
/* End of file details.php */
