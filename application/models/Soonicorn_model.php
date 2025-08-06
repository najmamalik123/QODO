<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Model
*
* Version: 2.5.2
*
* Author:  Ben Edmunds
* 		   ben.edmunds@gmail.com
*	  	   @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Last Change: 3.22.13
*
* Changelog:
* * 3-22-13 - Additional entropy added - 52aa456eef8b60ad6754b31fbdcc77bb
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class soonicorn_model extends CI_Model{

	public function get_founders($startup,$limit,$style,$type){
		switch($style){
			case 'list':
				$getallmemebsr=$this->db->query("select * from x_soo_people where xsp_startup='$startup' and xsp_status ='0' and xsp_type='$type' order by xsp_order asc limit $limit ");
				return $allmemebsr=$getallmemebsr->result_array();
			break;
		}
	}

// ////
}