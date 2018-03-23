<?php
$blogBaseUrl = $this->config->item('base_url');
?>

<div id="edite_list" class="container-fluid">
    <div class="container">
        <h2 class="admin-title"> <?php echo $title ;?> </h2>
        <a class="button" href="<?php echo $blogBaseUrl .'/_p123/cdisc';?>">ساخت کد تخفیف</a>
            <div class="list-head-wrapper">
                <div class="list-head col-1 col-md-1 col-lg-1">
                    Edite
                </div>
                <div class="list-head col-2 col-md-2 col-lg-2">
                    Award Text
                </div>
                <div class="list-head col-4 col-md-4 col-lg-4">
                    Discount Code
                </div> 
                <div class="list-head col-2 col-md-2 col-lg-2">
                    Discount State
                </div>
                <div class="list-head col-3 col-md-3 col-lg-3">
                    Discount time of using
                </div>                         
            </div>
            <?php

                if(is_array($discs_list)){
                    foreach ($discs_list as $disc_value) {?>
                        <div class="list-body-wrapper"> 
                            <?php
                            foreach ($disc_value as $key => $field ) {
                                if($key == 'discont_id'){
                                    echo '<div class="list-col col-1 col-md-1 col-lg-1" >
                                            <a href="'.$blogBaseUrl.'/_p123/edisc/'.$field.'" > Edite </a>
                                        </div>';
                                }elseif($key == 'award_text'){?>
                                    <div class="list-col col-2 col-md-2 col-lg-2" >
                                        <?php echo $field; ?>
                                    </div>
                                <?php
                                }elseif($key == 'discont_code'){?>
                                    <div class="list-col col-4 col-md-4 col-lg-4">
                                        <?php echo $field; ?>
                                    </div>
                                        <?php
                                }elseif($key == 'discont_utime'){?>
                                    <div class="list-col col-3 col-md-3 col-lg-3">
                                        <?php echo $field; ?>
                                    </div>
                                    <?php
                                }elseif($key == 'discont_state'){?>
                                    <div class="list-col col-2 col-md-2 col-lg-2" >
                                        <?php 
                                        if($field){
                                            echo '<p class="disc-used">USED</p>';
                                        }else{
                                            echo '<p class="disc-valid">VALID</p>';
                                        }?>
                                    </div>
                                <?php
                                }

                            }?>    
                        </div>
                        <?php 
                    }
                }
            ?>
    </div>	
</div>