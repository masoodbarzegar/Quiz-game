<?php

$blogBaseUrl = $this->config->item('base_url');
?>

<div id="edite_list" class="container-fluid">

    <div class="container">

        <h2 class="admin-title"> <?php echo $title ;?> </h2>

            <div class="list-head-wrapper">

                <div class="list-head col-2 col-md-2 col-lg-2">

                    Game ID

                </div> 

                <div class="list-head col-2 col-md-2 col-lg-2">

                    Player ID

                </div> 

                <div class="list-head col-2 col-md-2 col-lg-2">

                    Game Token

                </div>

                <div class="list-head col-2 col-md-2 col-lg-2">

                    Game Start Time

                </div> 

                <div class="list-head col-4 col-md-4 col-lg-4">

                    Award ID

                </div>                      

            </div>

            <?php

                if(is_array($games_list)){

                    foreach ($games_list as $game_value) {?>

                        <div class="list-body-wrapper"> 

                            <?php

                            foreach ($game_value as $key => $field ) {

                                if($key == 'game_id'){

                                    echo '<div class="list-col col-2 col-md-2 col-lg-2" >';

                                    //echo '<a href="'.$blogBaseUrl.'/_p123/lplayergame/'.$field.'" > Edite </a>';

                                    echo $field;

                                    echo '</div>';

                                }elseif($key == 'player_id'){

                                    echo '<div class="list-col col-2 col-md-2 col-lg-2" >';

                                        echo '<a href="'.$blogBaseUrl.'/_p123/lplayergame/'.$field.'" > Player data - '. $field .' </a>';

                                    echo '</div>';

                                }elseif($key == 'award_id'){

                                    echo '<div class="list-col col-4 col-md-4 col-lg-4" >';

                                            
                                        if($field == 1){
                                            echo '<p> 10 هزار تومان هدیه ثبت نام</p>';
                                        }elseif($field == 2){
                                            echo '<p>40 هزار تومان هدیه ثبت نام</p>';
                                        }elseif($field == 4){
                                            echo '<p>50 هزار تومان جایزه نقدی</p>';
                                        }elseif($field == 5){
                                            echo '<p>100 هزار تومان جایزه نقدی</p>';
                                        }elseif($field == 6){
                                            echo '<p>ربع سکه بهار آزادی</p>';
                                        }else{
                                            echo '<a href="'.$blogBaseUrl.'/_p123/show_award/'.$field.'" > Award id - '.$field.'</a>';
                                        }

                                    echo '</div>';

                                }else{

                                    echo '<div class="list-col col-2 col-md-2 col-lg-2">';

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