<?php

$blogBaseUrl = $this->config->item('base_url');

?>



<div id="edite_list" class="container-fluid">

    <div class="container">

        <h2 class="admin-title"> <?php echo $title ;?> </h2>

            <div class="list-head-wrapper">

                <div class="list-head col-4 col-md-4 col-lg-4">

                    Player Phone

                </div> 

                <div class="list-head col-4 col-md-4 col-lg-4">

                    Player Email

                </div> 

                <div class="list-head col-4 col-md-4 col-lg-4">

                    Player Game list

                </div>                      

            </div>

            <?php

                if(is_array($players_list)){

                    foreach ($players_list as $palyer_value) {?>

                        <div class="list-body-wrapper"> 

                            <?php

                            foreach ($palyer_value as $key => $field ) {

                                if($key == 'player_id'){

                                    echo '<div class="list-col col-4 col-md-4 col-lg-4" >

                                            <a href="'.$blogBaseUrl.'/_p123/lplayergame/'.$field.'" > Player - '. $field .' </a>

                                        </div>';

                                }else{

                                    echo '<div class="list-col col-4 col-md-4 col-lg-4">';

                                        echo $field;

                                    echo '</div>';

                                }

                                    

                            }?>    

                        </div>

                        <?php 

                    }

                }

            ?>

    </div>  

</div>