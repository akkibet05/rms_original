<?php

//This class is made for the installer to work
//A copy is also made at the root of file index.php by name external.php

class MY_Input extends CI_Input {

	public function __construct()
	{
		if (defined('CODEIGNITER_EXTERNAL_ACCESS'))
		{
		    return;
		}

		parent::__construct();	
	}
}