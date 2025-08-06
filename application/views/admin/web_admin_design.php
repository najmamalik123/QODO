<?php
$pageNum = @$_GET['page'];
if ($pageNum == NULL || $pageNum =='0') {$pageNum = 1;   }
$resultsPerPage='50';
$limit1 = $pageNum * $resultsPerPage - $resultsPerPage;
$limit2 =  $resultsPerPage;

$thecats=$this->db->query("select * from yn_site_catagory");
$thsersftsy=$thecats->result_array();
  foreach($thsersftsy as $thedats_0 ){
    $categories[] = array("id" => $thedats_0['ctid'], "val" => $thedats_0['name']);
  }

  $thecats2=$this->db->query("select * from yn_site_sub_cat");
$thsersftsy2=$thecats2->result_array();
  foreach($thsersftsy2 as $thedats_2 ){
    $subcats[$thedats_2['sc_ctid']][] = array("id" => $thedats_2['sc_id'], "val" => $thedats_2['sc_name']);
  }

  $thecats23=$this->db->query("select * from yn_site_sub2_cat");
$thsersftsys2=$thecats23->result_array();
  foreach($thsersftsys2 as $thedats_2s ){
    $subcatss[$thedats_2s['mr_sub2_sid']][] = array("id" => $thedats_2s['mr_sub2_id'], "val" => $thedats_2s['mr_sub2_name']);
  }

  @$jsonCats = json_encode($categories);
  @$jsonSubCats = json_encode(@$subcats);
  @$jsonSubCats2 = json_encode(@$subcatss);
?>

          <div class="row ml-0">
            <?php
              $sub_perform = $this->uri->segment(4);
                switch($sub_perform){
                  case 'add-admin': 

                  break;
                }
                ?>
            </div>