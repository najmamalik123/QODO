<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function index($slug){
	$get_all_blocks=$this->db->query("select * from yn_admin_pages where slug ='$slug' ");
    $the_pages_data=$get_all_blocks->row_array();

    	
    		$data=db_variables();
    		$data['seo_title'] = 'AyuScholar - India’s First E- Learning Platform for Ayurveda';
    		$data['seo_description'] = 'AyuScholar - India’s First E- Learning Platform for Ayurveda';
    		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
    		$data['seo_keywords'] = 'keywords';
    		$data['page_name']='Ynaps.com';
    		
    		$data['page_data']=$the_pages_data['content'];

    		// $this->load->view('inc/_header',$data);
    		// $this->load->view('inc/_page_data.php',$data);
    		// $this->load->view('inc/_footer',$data);
    	}

    }