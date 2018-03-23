<?php
$blogBaseUrl = $this->config->item('base_url');
?>

<div id="edite_list" class="container-fluid">
    <div class="container">
        <h2 class="admin-title"> <?php echo $title ;?> </h2>
        <a class="button" href="<?php echo $blogBaseUrl .'/_p123/caward';?>">ایجاد جایزه</a>
            <div class="list-head-wrapper">
                <div class="list-head col-2 col-md-2 col-lg-2">
                    Edite
                </div>
                <div class="list-head col-10 col-md-10 col-lg-10">
                    Award text
                </div>                    
            </div>
            <?php

                if(is_array($awards_list)){
                    foreach ($awards_list as $award_value) {?>
                        <div class="list-body-wrapper"> 
                            <?php
                            foreach ($award_value as $key => $field ) {
                                if($key == 'award_id'){
                                    echo '<div class="list-col col-2 col-md-2 col-lg-2" >
                                            <a href="'.$blogBaseUrl.'/_p123/eaward/'.$field.'" > Edite </a>
                                        </div>';
                                }else{?>
                                    <div class="list-col col-10 col-md-10 col-lg-10" >
                                        <?php echo $field; ?>
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