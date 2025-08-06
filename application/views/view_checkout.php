<?php 
    $id=$_GET['chk'];
    $getslider_details=$this->db->query("select * from `x-orders` where or_order_id='$id' ");
    $theimage_details3=$getslider_details->row_array();
    $theidval=$_GET['chk'];
    
    if ($getslider_details->num_rows()>0) {
                      $Odr_Details = $getslider_details->result_array();
                      $order_chk_id = $Odr_Details[0]['checkout_order_id'];
                      ?>
                      <div class="container">
                        <div class="row">
                          <div class="mb-4 card col-sm-12">
                        <div class="card-body"><h5 class="card-title">Order Details</h5>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <td>Order #</td>
                                  <td class="font-weight-bold"><?=$Odr_Details[0]['checkout_order_id']?></td>
                                  <td>Checkout Date</td>
                                  <td class="font-weight-bold"><?=$Odr_Details[0]['checkout_date']?></td>
                                </tr>
                                <tr>
                                  <td>Name</td>
                                  <td class="font-weight-bold"><?=$Odr_Details[0]['first_name']?></td>
                                  <td>Billing Address</td>
                                  <td class="font-weight-bold"><?=$Odr_Details[0]['address']?></td>
                                </tr>
                                <tr>
                                  <td>Phone#</td>
                                  <td class="font-weight-bold"><?=$Odr_Details[0]['phone']?></td>
                                  <td>Email</td>
                                  <td class="font-weight-bold"><?=$Odr_Details[0]['email']?></td>
                                </tr>
                                <tr>
                                  <td>Total Price</td>
                                  <td class="font-weight-bold"><?=number_format($Odr_Details[0]['checkout_price'],2)?></td>
                                  <td>City/Pin</td>
                                  <td class="font-weight-bold"> <?=$Odr_Details[0]['city']?><br><?=$Odr_Details[0]['checkout_pin']?> </td>
                                </tr>
                                <tr>
                                  <td>Order Status</td>
                                  <td class="font-weight-bold"><?=read_me_user('cstatus',$Odr_Details[0]['checkout_status'])?></td>
                                  <td>Payment Status</td>
                                  <td class="font-weight-bold"><?=read_me_user('cpay',$Odr_Details[0]['chk_payment_status'])?></td>
                                </tr>
                                <!-- <tr>
                                  <td>Date of Use</td>
                                  <td class="font-weight-bold"><?=date('D jS M Y',strtotime($Odr_Details[0]['chk_user_date']))?></td>
                                  
                                  <td>Time of Expiry</td> 
                                 <td class="font-weight-bold"><?=@$Odr_Details['0']['time']?></td> 
                                </tr> -->
                              </tbody>
                            </table>
                            <div class="table-responsive">
                              <fieldset><h5>Products List</h5></fieldset>
                                    <table class="table table-borderless">
                                      <tbody>
                                        <?php 
                                        $Order_listPro = $this->db->query("SELECT * from `x-orders-detail` where checkout_order_id='$order_chk_id' ");
                                        if ($Order_listPro->num_rows()>0) {
                                          $index = 0;
                                          foreach ($Order_listPro->result_array() as $productList) {
                                            $index++;
                                            ?>
                                            <tr>
                                              <td><?=$index?></td>
                                              <td><img width="60px" style="width: 60px; border-radius: 20px;" class="ec-cart-pro-img mr-4" src="<?=base_url('assets/avator/upload/')?><?=$productList['xod_image1']?>" alt=""></td>
                                              <td><?=$productList['xod_title']?></td>
                                              <td><?=$productList['xod_name']?></td>
                                              <td><?=$productList['xod_price']?></td>
                                              <td><?=$productList['xod_qty']?></td>
                                              <td><?=$productList['xod_price']?> x <?=$productList['xod_qty']?> <br/><b>Total : <b class="text-warning"><?=number_format($productList['xod_qty']*$productList['xod_price'])?></b> </b></td>
                                            </tr>
                                            <?php
                                          }
                                        }else{
                                          echo "<div class='alert alert-info'>Empty Product List!</div>";
                                        }
                                         ?>
                                      </tbody>
                                    </table>
                            </div>
                          </div>

                        </div>
                      </div>
                      <a class="btn btn-secondary" href="<?=base_url('profile')?>">Back to Profile</a>
                        </div>
                      </div>
                      <?php
                    }else{
                      echo "<div class='alert alert-info'>Empty data!</div>";
                    }
 ?>