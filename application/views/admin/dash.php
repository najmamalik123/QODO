<?php include_once('inc/admin_header.php');
include_once('inc/ynaps_admin_side_bar.php');
include_once('inc/admin_top.php'); ?>
                    <div class="row">
              			<div class="col-sm-6 mb-sm-5">
                            <div class="card-body  bg-white shadow"><h5 class="card-title">Leads</h5>
                                <div class="table-responsive mt-4" style="max-height:400px;overflow: auto;">
                                   <canvas id="lineChart2"></canvas>
                                </div>
                            </div>
                        </div>

                        
                        <?php if(check_service_status('1','2','news') =='1' ){ ?>
                        <div class="col-sm-6 ">
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title">News</h5>
                                    <div class="table-responsive mt-4" style="max-height:340px;overflow: auto;">
                                       <?php 
                                       $the_dats=get_data_from_nodlys('2',$_SESSION['lic_key'],'1'); 
                                       $myArray = json_decode($the_dats, true);
                                       ?>
                                       
                                       <?php 
                                       foreach($myArray as $key => $value ){ ?>
                                            <div class="col-12 pb-2" style="border-bottom:1px dashed #eee;">
                                                <?=$value['ndl_head']?><br/>
                                                <small> <i class="fa-thin fa-calendar-days"></i> <?=date_format_1($value['ndl_date'],1)?> | <b> Expiry:</b>  <?=date_format_1($value['ndl_exp'],1)?> </small><br/>
                                                <small>
                                                    <?=trim_text($value['ndl_desc'],200,'...')?>
                                                </small>
                                                <?php if($value['ndl_link'] !=''){ ?> <a href="<?=$value['ndl_link']?>"> open </a> <?php } ?>
                                            </div>
                                       <?php } ?>
                                    </div>
                                </div>
                            </div>                                         
                        </div>
                    <?php } ?>

                        <?php if(check_service_status('1','2','usr') =='1' ){ ?>
                        <div class="col-sm-6 mb-sm-5 ">
                            <div class="card-body shadow bg-white"><h5 class="card-title">Users</h5>
                                <div class="table-responsive mt-4" style="max-height:400px;overflow: auto;">
                                   <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        
                  <?php 
              $getallmesgaes=$this->db->query("select * from yn_site_contact order by msid desc limit 100");
              $theallamesages=$getallmesgaes->result_array();
                  ?>
                    <div class="col-sm-6">
                                <div class="main-card mb-3 card" style="max-height:400px;overflow:auto;">
                                    <div class="card-body"><h5 class="card-title">Contact Requests</h5>
                                        <table class="mb-0 table table-responsive-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <!-- <th>Email</th> -->
                                                <th>Phone</th>
                                                <th>Subject</th>
                                                <th style="max-width: 450px;">Message</th>
                                                <th><a href="<?=base_url('index.php/admin/perform/web/contacts')?>">Course Name</a></th>
                                                <th>Date</th>
                                                <!-- <th>IP</th>
                                                <th>Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                              <?php foreach($theallamesages as $mess){ ?>
                                            <tr>
                                                <th scope="row"><?=$mess['msid']?></th>
                                                <td><?=$mess['name']?></td>
                                                <!-- <td><?=$mess['email']?></td> -->
                                                <td><?=$mess['phone']?></td>
                                                <td><?=$mess['subject']?></td>
                                                <td style="max-width: 250px;"><?=$mess['msg']?></td>
                                                <td><a href="<?=base_url('index.php/admin/perform/web/contacts?cid=')?><?=@$mess['con_cid']?>"><?=@$mess['con_cname']?></a></td>
                                                <td><?=date_format_1($mess['date'],1)?></td>
                                                <!-- <td><?=$mess['ip']?></td> -->
                                                <td>
                                                <!-- <a onclick="return confirm('Are you sure you want to delete this?');" href="<?=base_url('index.php/admin_action/delete')?>?id=<?=$mess['msid']?>&what=msg" target='_blank'>
                                                  <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button></a> -->
                                                </td>
                                            </tr>
                                          <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                            

                        </div>
                    <?php include_once('inc/admin_footer.php'); ?>