<div class="app-wrapper-footer shadow text-white py-2" style="background:#f8f8f8;border-radius: 8px;">
                        <div class="app-footer py-1">
                            <div class="app-footer__inner row">
                                <div class="app-footer-left col-sm-6">
                                    <ul class="nav">
                                        <li class="nav-item">
                                        </li>
                                        <li class="nav-item">
                                            <a href="https://ynaps.com/contact" class="nav-link" target="_blank">
                                                Contact YNAPS
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="<?=base_url('index.php/logout')?>" class='btn_2 btn' >
                                        Logout
                                    </a>
                                  <br/><small class="text-muted">All Rights reserved @ Nodly's by YNAPS V1.1</small>
                                </div>
                            </div>
                        </div>
                    </div>    </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="<?=base_url('assets/admin')?>/scripts/main.js"></script>
<script type="text/javascript" src="<?=base_url('assets/admin')?>/scripts/jquery.form.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/admin')?>/scripts/jquery.form.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard-all/ckeditor.js"></script>
</body>

<?php
$themonth=date("m");
$themon_yh=date("y");
$geththesales_3843=$this->db->query("select * from yn_site_contact where (YEAR(date) = '$themon_yh') and (MONTH(date) = '$themonth') GROUP BY DAY(date)");
$the_details_rpid=$geththesales_3843->result_array();

$cr_pay33='';
foreach($the_details_rpid as $reships_mo){
    $cr_pay33=$cr_pay33.','.$reships_mo['msid'];
}
$cr_pay33=substr($cr_pay33,1);


$last = $this->uri->total_segments();
$productID =  $this->uri->segment($last);

if($productID =='success' || @$_GET['msg']=='success' ){ ?>
<script>
  swal('Success',"your request processed",'success');
</script>
<?php } ?>

<?php if( isset($_GET['msgg']) && @$_GET['msgg'] !='success' ){ ?>
<script>
  swal('You have an Alert',"<?=$_GET['msgg']?>");
</script>
<?php } ?>

<script>
$('.rich_text').each( function () {
var theid_dats=this.id;
 CKEDITOR.replace( theid_dats , {
      on : {
            change: function ( evts )  {
            $('#'+theid_dats).html(evts.editor.getData().replace(/(\r\n|\n|\r)/gm,"") ) ;
            }
        },
      // extraPlugins: 'mathjax,colorbutton,font,justify,print,tableresize,uploadimage,uploadfile,pastefromword,liststyle,pagebreak',
      // mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
      height: 120
    });


    if (CKEDITOR.env.ie && CKEDITOR.env.version == 8) {
      document.getElementById('ie8-warning').className = 'tip alert';
    }
});

<?php
        // echo "var categories = $jsonCats; \n";
        // echo "var subcats = $jsonSubCats; \n";
        // echo "var subcatss = $jsonSubCats2; \n";
      ?>
</script>


<script type="text/javascript">
  function load_subcat(obj){
      // alert('ok');
      var thecat=$(obj).children("option:selected").val();
      $('#get_subcat_data').load("<?=base_url('ynaps_load/load_subcat?cat=')?>"+thecat);
  }
  function load_getsub2Cat(obj){
      var thecat=document.getElementById('make').value;
      var thescat=$(obj).children("option:selected").val();
      $('#get_sub2Cat_data').load("<?=base_url('ynaps_load/load_getsub2Cat?cat=')?>"+thecat+"&scat="+thescat);
  }
  function load_srch_href(obj){
      var thescat=$(obj).children("option:selected").val();
      var thecat=document.getElementById('cat').value;
      Url='?cat='+thecat+"&scat="+thescat;
      document.getElementById("sub2cat_srch").href = document.getElementById("sub2cat_srch").href + Url;
  }


</script>

<script type="text/javascript">
                           //line
                           var ctxL = document.getElementById("lineChart2").getContext('2d');
                           var myLineChart = new Chart(ctxL, {
                             type: 'line',
                             data: {
                               labels: ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30"],
                               datasets: [{
                                 label: "Leads",
                                 data: [<?=$leads_graph?>],
                                 backgroundColor: [
                                   'rgba(95, 3, 322, .4)',
                                 ],
                                 borderColor: [
                                   'rgba(180, 99, 282, .4)',
                                 ],
                                 borderWidth: 2
                               },{
                                 label: "Leads Last Month",
                                 data: [<?=$leads_graph_last?>],
                                 backgroundColor: [
                                   'rgba(95, 3, 172, .3)',
                                 ],
                                 borderColor: [
                                   'rgba(200, 99, 132, .7)',
                                 ],
                                 borderWidth: 2
                               }
                               ]
                             },
                             options: {
                               responsive: true
                             }
                           });
                       </script>

                       <script type="text/javascript">
                           //line
                           var ctxL = document.getElementById("lineChart").getContext('2d');
                           var myLineChart = new Chart(ctxL, {
                             type: 'line',
                             data: {
                               labels: ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30"],
                               datasets: [{
                                 label: "Users",
                                 data: [<?=$mem_graph?>],
                                 backgroundColor: [
                                   'rgba(95, 3, 122, .3)',
                                 ],
                                 borderColor: [
                                   'rgba(200, 99, 132, .7)',
                                 ],
                                 borderWidth: 2
                               },{
                                 label: "Last Month Users",
                                 data: [<?=$mem_graph_last?>],
                                 backgroundColor: [
                                   'rgba(95, 3, 122, .3)',
                                 ],
                                 borderColor: [
                                   'rgba(200, 99, 132, .7)',
                                 ],
                                 borderWidth: 2
                               }
                               ]
                             },
                             options: {
                               responsive: true
                             }
                           });



                       </script>

                       <script type="text/javascript">

                        function change_prod(){
                          
                        }
                         
                         function load_new_city(obj){
                               var thestate=$(obj).children("option:selected").val();
                               $('#get_cities_data').load("<?=base_url('ynaps_load/load_city?state=')?>"+thestate);
                           }
                         function load_new_state(obj){
                               var thecountry=$(obj).children("option:selected").val();
                               $('#get_state_data').load("<?=base_url('ynaps_load/load_state?country=')?>"+thecountry);
                           }
                       </script>
</html>
