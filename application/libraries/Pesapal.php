<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Get  OAuth
require_once(APPPATH.'libraries/PesaPalFile/OAuth.php');
require_once(APPPATH.'libraries/PesaPalFile/checkStatus.php');
 
class Pesapal
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

}