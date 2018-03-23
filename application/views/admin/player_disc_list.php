<?php

$blogBaseUrl = $this->config->item('base_url');


?>

<div id="edite_list" class="container-fluid">

    <div class="container">

        <h2 class="admin-title"> <?php echo $title ;?> </h2>

            <div class="list-head-wrapper">

                <div class="list-head col-2 col-md-2 col-lg-2">

                    Discount ID

                </div> 

                <div class="list-head col-2 col-md-2 col-lg-2">

                    Award ID

                </div> 

                <div class="list-head col-2 col-md-2 col-lg-2">

                    Discount Code

                </div>

                <div class="list-head col-2 col-md-2 col-lg-2">

                   Discount Status

                </div> 

                <div class="list-head col-2 col-md-2 col-lg-2">

                    discont Time

                </div>                      

                <div class="list-head col-2 col-md-2 col-lg-2">

                    Player ID

                </div>                      

            </div>

            <?php

                if(is_array($player_disc_list)){

                    foreach ($player_disc_list as $player_disc_value) {?>

                        <div class="list-body-wrapper"> 

                            <?php

                            foreach ($player_disc_value as $key => $field ) {

                                
                                    echo '<div class="list-col col-2 col-md-2 col-lg-2" >';

                                        echo $field;

                                    echo '</div>';
  

                            }?>    

                        </div>

                        <?php 

                    }

                }

            ?>

    </div>  

</div>