<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php"; 

class Excel extends PHPExcel
{
	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
}

/* End of file Excel.php */
/* Location: ./application/libraries/Excel.php */