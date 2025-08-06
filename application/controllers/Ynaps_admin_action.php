<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ynaps_admin_action extends CI_Controller {

	function settings_web(){
		$s=$this->input->post('s');
		switch ($s){
			case '1':
			$etype=$this->input->post('etype');
			$host=$this->input->post('host');
			$pass=$this->input->post('pass');
			$key=$this->input->post('key');
			$t=$this->input->post('t');
			$v1=$this->input->post('v1');
			$v2=$this->input->post('v2');

			$checkdb=$this->db->query("select * from yn_site_keys where ki_type ='$t' ");
			if($checkdb->num_rows() == 0 ){
				$insert_dates=$this->db->query("insert into yn_site_keys (ki_key,ki_pass,ki_host,ki_type,ki_status,ki_v1,ki_v2) values ('$key','$pass','$host','$t','1','$v1','$v2') ");
				echo 'YNAPS_SUCCESS';
			}else if($checkdb->num_rows() == 1 ){
				$update_the=$this->db->query("update yn_site_keys set ki_key='$key',ki_pass='$pass',ki_host='$host',ki_status='1',ki_v1='$v1',ki_v2='$v2' where ki_type='$t' ");
				echo 'YNAPS_SUCCESS';
			}

			break;
			case '5':
				case '1':

			$ser=$this->input->post('ser');
			$t=$this->input->post('t');

			$key=implode(',',$ser);

			$checkdb=$this->db->query("select * from yn_site_keys where ki_type ='$t' ");
			if($checkdb->num_rows() == 0 ){
				$insert_dates=$this->db->query("insert into yn_site_keys (ki_key,ki_type) values ('$key','$t') ");
				echo 'YNAPS_SUCCESS';
			}else if($checkdb->num_rows() == 1 ){
				$update_the=$this->db->query("update yn_site_keys set ki_key='$key' where ki_type='$t' ");
				echo 'YNAPS_SUCCESS';
			}


			$checkdb=$this->db->query("select * from yn_site_keys where ki_type ='ser' ");
			$the_d_values=$checkdb->row_array();
			$_SESSION['admin_data']['the_d_values']=$the_d_values['ki_key'];

			break;

			case 'css':
			$css=addslashes($this->input->post('css'));
			$checkdb=$this->db->query("select * from yn_admin_pages where name ='CUSTOM-ALL' ");
			if($checkdb->num_rows() == 0 ){
				$insert_dates=$this->db->query("insert into yn_admin_pages (pg_css,name) values ('$css','CUSTOM-ALL') ");
				echo 'YNAPS_SUCCESS';
			}else if($checkdb->num_rows() == 1 ){
				$update_the=$this->db->query("update yn_admin_pages set pg_css='$css' where name='$t' ");
				echo 'YNAPS_SUCCESS';
			}
			break;

			case 'emtemp':
			$em_temp=addslashes($this->input->post('em_temp'));
				$update_the=$this->db->query("update yn_admin_files set em_temp='$em_temp' where asid='1' ");
				echo 'YNAPS_SUCCESS';
			break;

			case 'mfo':
			$css=addslashes($this->input->post('css'));
			$update_the=$this->db->query("update yn_admin_files set mo_footer='$css' where asid='1' ");
			echo 'YNAPS_SUCCESS';
			break;

			case 'wab':
			$css=addslashes($this->input->post('css'));
			$update_the=$this->db->query("update yn_admin_files set wa_btn='$css' where asid='1' ");
			echo 'YNAPS_SUCCESS';
			break;

			case 'dis':
			$css=addslashes($this->input->post('css'));
			$update_the=$this->db->query("update yn_admin_files set disqus='$css' where asid='1' ");
			echo 'YNAPS_SUCCESS';
			break;

			case 'h1':
			case 'h2':
			case 'f1':
			case 'f2':
			case 'ocss':
			$check_theme=$this->db->query("select * from  yn_site_theme where thm_status='1' ");
			if($check_theme->num_rows() !=1){
				echo 'You do not have any active theme please activate one.'; die;
			}else{
				switch ($s){
					case 'ocss':
						$the_field_name='thm_css';
					break;case 'h1':
						$the_field_name='thm_header1';
					break;case 'h2':
						$the_field_name='thm_header2';
					break;case 'f1':
						$the_field_name='thm_footer1';
					break;case 'f2':
						$the_field_name='thm_footer2';
					break;
				}
				$css=addslashes($this->input->post('css'));
				$updatetheme_s=$this->db->query("update yn_site_theme set $the_field_name='$css' where thm_status='1' ");
				echo 'YNAPS_SUCCESS';
			}


			break;

			default:

			break;
		}


	}


function reset_data($data){
	switch ($data){
		case 'sli':
			$this->db->query("delete from yn_site_img where img_place='slider1' ");
			redirect($_SERVER['HTTP_REFERER']);
		break;case 'sli':
			$this->db->query("delete from yn_site_img where img_place='slider1' ");
			redirect($_SERVER['HTTP_REFERER']);
		break;
	}
}


}