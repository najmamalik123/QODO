<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		@$aid=$_SESSION['aid'];
        if($aid !='' || isset($_SESSION['aid']) ){
        	redirect("admin/dash");
        }
        $this->load->view('admin/login.php');
	}

	function get_license(){

	$aid=$_SESSION['aid'];
	if(@$aid =='' || !isset($_SESSION['aid']) ){
		redirect("admin/login");
	}

    $thedomain=$_SERVER['HTTP_HOST'];
    $get_raths=$this->db->query("select * from  yn_admin_license where li_domain='$thedomain'  ");
    $thedata_key=$get_raths->num_rows();
    $_SESSION['lic_key']=$thedata_key['li_key'];

    if($get_raths->num_rows() !=0){
        redirect(base_url('error-404?e=License is already active.'));
    }

		$this->load->view('admin/yn_license.php');
	}

	public function login()
	{
		@$aid=$_SESSION['aid'];
        if($aid !='' || isset($_SESSION['aid']) ){
        	redirect("admin/dash");
        }
        $this->load->view('admin/login.php');
	}

	public function dash()
	{
        $aid=$_SESSION['aid'];
        if(@$aid =='' || !isset($_SESSION['aid']) ){
        	redirect("admin/login");
        }
        $getadmin_det=$this->db->query("select * from yn_admin where aid='$aid' ");

        $this->load->helper('admin_help');
        $admin_m=admin_meta();
        $thearrayvalues=array();
        $thearrayvalues['admin_meta']=$admin_m;

        

        $theuser_row=$getadmin_det->row_array();
        $thearrayvalues['site_name']=$theuser_row['user'];
        $thearrayvalues['owner']='Admin';
        $this->load->view('admin/dash',$thearrayvalues);
	}

	public function logout(){
		session_start();
	$helper = array_keys($_SESSION);
    foreach ($helper as $key => $name){
    unset($_SESSION[$name]);  }

    $_SESSION['email'] = '';
	$_SESSION['auth'] = '';
	$_SESSION['core'] = '';
	$_SESSION['logmail'] = '';
	$_SESSION['details'] = '';
	$_SESSION['auth-admin'] = '';

	unset($_SESSION['auth-admin']);
	unset($_SESSION['email']);
	unset($_SESSION['auth']);
	unset($_SESSION['core']);
	unset($_SESSION['logmail']);
	unset($_SESSION['details']);
	session_destroy();

	redirect('admin');
	}
	public function perform($action){
		$aid=$_SESSION['aid'];
        if($aid =='' || !isset($_SESSION['aid']) ){
        	redirect("admin/login");
        }

		$this->load->helper('admin_help');
        $admin_m=admin_meta();
        $thearrayvalues=array();

        $thearrayvalues['admin_meta']=$admin_m;
        $thearrayvalues['site_name']='Boldini';
        $thearrayvalues['owner']='Admin';
        $thearrayvalues['perform']=$action;
		switch($action){
			case 'custom':
				$this->load->view('admin/inc/admin_header.php',$thearrayvalues);
				$this->load->view('admin/inc/ynaps_admin_side_bar.php',$thearrayvalues);
				$this->load->view('admin/inc/admin_top.php',$thearrayvalues);
				$this->load->view('admin/custom_admin_design',$thearrayvalues);
				$this->load->view('admin/inc/admin_footer.php',$thearrayvalues);

			break;
			case 'products':
				$this->load->view('admin/inc/admin_header.php',$thearrayvalues);
				$this->load->view('admin/inc/ynaps_admin_side_bar.php',$thearrayvalues);
				$this->load->view('admin/inc/admin_top.php',$thearrayvalues);
				$this->load->view('admin/custom_admin_design',$thearrayvalues);
				$this->load->view('admin/inc/admin_footer.php',$thearrayvalues);

			break;
			default:
				$this->load->view('admin/inc/admin_header.php',$thearrayvalues);
				$this->load->view('admin/inc/ynaps_admin_side_bar.php',$thearrayvalues);
				$this->load->view('admin/inc/admin_top.php',$thearrayvalues);
				// $this->load->view('admin/web_admin_design.php',$thearrayvalues);
				$this->load->view('admin/ynaps_admin_section.php',$thearrayvalues);
				$this->load->view('admin/inc/admin_footer.php',$thearrayvalues);
			break;
		}
	}


	function city_select(){
		$count_code=$this->input->post('country_id');
		$state_id2=$this->input->post('state_id');


	if(!empty($count_code)){
    //Fetch all state data
    $query = $this->db->query("SELECT * FROM site_states WHERE country_id = ".$count_code." AND status = 1 ORDER BY state_name ASC");
    $thedatss=$query->result_Array();
    $rowCount = $query->num_rows();
    //State option list
    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        foreach($thedatss as $row){
            echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}elseif(!empty($state_id2)){
    $query2 = $this->db->query("SELECT * FROM site_cities WHERE state_id = ".$state_id2." AND status = 1 ORDER BY city_name ASC");
    $thedatss2=$query2->result_Array();
    $rowCount2 = $query2->num_rows();

    //City option list
    if($rowCount2 > 0){
        echo '<option value="">Select city</option>';
        foreach($thedatss2 as $row){
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
} }


}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */