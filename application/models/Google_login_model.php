<?php
class Google_login_model extends CI_Model{

 function Is_already_register($id){
  $this->db->where('social_login', $id);
  $query = $this->db->get('site_mem');
  if($query->num_rows() > 0){
    $query=$this->db->query("select * from yn_site_mem where social_login='$id' and user_status !='2' ");
        if($query ->num_rows() =='1'){
            $dats_op=$query->row_array();
            if($dats_op['user_status'] =='2'){echo "We are sorry, But your account is suspended. Please contact us for more."; die; }
                @session_start();
                $yid=$dats_op['mid'];
                $_SESSION['yid']=$yid;
                $_SESSION['name']=$dats_op['name'];
                $_SESSION['email']=$dats_op['email'];
                $_SESSION['phone']=$dats_op['contact'];
                $_SESSION['verify']=$dats_op['verify'];
                $_SESSION['photo']=$dats_op['photo'];
                $_SESSION['plan']=$dats_op['user_plan'];
                $_SESSION['user_type']=$dats_op['user_type'];
                //Assign Login UserID to the cookie keyword
                set_keyword_cookie($yid);
            return true; }else{return false;}
        }else{ return false;}
    }

 function Insert_user_data($signup_data,$email,$phone,$name){
  $receive=$this->ynaps_model->signup($signup_data,$email,$phone);
            if($receive =='YNAPS_SUCCESS'){
            $yid=$_SESSION['yid'];
            $dirPath = "assets/mem/$yid";
            $dirPath2 = "assets/mem/$yid/img/";
            mkdir($dirPath, 0777, TRUE);
            mkdir($dirPath2, 0777, TRUE);

            $file = base_url().'assets/avator/main-profile.jpg';
            $file2 = base_url().'assets/avator/cover.jpg';
            $tocoppy="$dirPath2/photo.jpg";
            $tocoppy2="$dirPath2/cover.jpg";
            $abch=copy($file, $tocoppy);
            $abch2=copy($file2, $tocoppy2);
                @session_start();
                  $_SESSION['yid']=$yid;
                  $_SESSION['name']=$name;
                $_SESSION['email']=$email;
                  $_SESSION['phone']=$phone;
                  //$_SESSION['user_type']=$user_type;
                  $_SESSION['verify']='0';
                  $_SESSION['photo']='photo.jpg';
                  $_SESSION['plan']='0';
            }else{
            echo $receive; die;
            }
 }

}
?>