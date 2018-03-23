<?php
$blogBaseUrl = $this->config->item('base_url');
?>

<div id="edite_list" class="container-fluid">
    <div class="container">
        <h2 class="admin-title"> <?php echo $title ;?> </h2>
            <div class="list-head-wrapper">
                <div class="list-head col-3 col-lg-3 col-md-12">
                    Edite
                </div>
                <div class="list-head col-3 col-lg-3 col-md-12">
                    Title
                </div>
                <div class="list-head col-3 col-lg-3 col-md-12">
                    Slug
                </div>
                <div class="list-head col-3 col-lg-3 col-md-12">
                    Text
                </div>                        
            </div>
            <?php
                foreach ($pages_list as $page_value) {?>
                    <div class="list-body-wrapper"> 
                        <?php
                        //var_dump($value);
                        foreach ($page_value as $key => $field ) {
                            if($key == 'id'){
                                echo '<div class="col-3 col-lg-3 col-md-12 list-col" >
                                        <a href="'.$blogBaseUrl.'/admin/page_edite/'.$field.'" > Edite </a>
                                    </div>';
                            }else{?>
                                <div class="col-3 col-lg-3 col-md-12 list-col" >
                                    <?php echo $field; ?>
                                </div>
                                    <?php
                            }
                        }?>    
                    </div>
                    <?php 
                }
            ?>
    </div>	
</div>