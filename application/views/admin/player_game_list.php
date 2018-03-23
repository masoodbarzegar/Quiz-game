<?php

$blogBaseUrl = $this->config->item('base_url');

?>



<div id="edite_list" class="container-fluid">

    <div class="container">

        <h2 class="admin-title"> <?php echo $title ;?> </h2>

            <div style="text-align: right;"> پست الکترونیک  : <?php echo $player_data['player_email'];?></div>

            <div style="text-align: right;"> موبایل : <?php echo $player_data['player_mob'];?></div>

            </br>

            <div class="list-head-wrapper">

                <div class="list-head col-12 col-md-6 col-lg-6">

                    Game Time

                </div>

                <div class="list-head col-12 col-md-6 col-lg-6">

                    Award Code

                </div>              

            </div>

            <?php



                if(is_array($player_games_list)){

                    foreach ($player_games_list as $player_game_value) {?>

                        <div class="list-body-wrapper"> 

                            <?php

                            foreach ($player_game_value as $key => $field ) {

                                if($key == 'award_id'){

                                    echo '<div class="list-col col-6 col-md-6 col-lg-6" >';
                                        if($field == 3){
                                            echo '<a href="'.$blogBaseUrl.'/_p123/show_award/'.$field.'" > Award id - '.$field.'</a>';
                                        }elseif($field == 1){
                                            echo '<p> 10 هزار تومان هدیه ثبت نام</p>';
                                        }elseif($field == 2){
                                            echo '<p>40 هزار تومان هدیه ثبت نام</p>';
                                        }elseif($field == 4){
                                            echo '<p>50 هزار تومان جایزه نقدی</p>';
                                        }elseif($field == 5){
                                            echo '<p>100 هزار تومان جایزه نقدی</p>';
                                        }elseif($field == 6){
                                            echo '<p>ربع سکه بهار آزادی</p>';
                                        }
                                    echo '</div>';

                                }else{

                                    echo '<div class="list-col col-12 col-md-6 col-lg-6">';

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