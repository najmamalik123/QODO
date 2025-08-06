<div class="container-fluid p-3">
    <div class="panel-group container text-black">
        <div class="panel panel-default ">
                    <center><h3 class='display-5 u_text theme_color'>Famous Places in India for pickup</h3></center>
                <div class="row">
                    <div class="col-sm-4">
                        <ul class="new_list_landmarks">
                            <?php $landmarks=get_landmarks(10); 
                            foreach ($landmarks as $key) {
                            ?>
                            <li>
                               <a href=''> <?=$key['ld_name']?></a>
                            </li>

                        <?php } ?>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</div>
