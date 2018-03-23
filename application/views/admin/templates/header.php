<?php
$blogBaseUrl = $this->config->item('base_url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php echo $blogBaseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $blogBaseUrl; ?>/css/back-v2.css" rel="stylesheet">
    <script src="<?php echo $blogBaseUrl; ?>/js/jquery.js"></script>
    <script src="<?php echo $blogBaseUrl; ?>/js/bootstrap.min.js"></script>
            
</head>

<body id="admin">
<!-- Navigation -->
<nav class="navbar navbar-inverse " role="navigation">
    <div class="container">
        <?php 
        //echo '<pre>';
        //var_dump($_SESSION);
        //echo '</pre>';
        ?>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $blogBaseUrl; ?>">بازگشت به سایت</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                 <?php 
                if($user_state['admin_user']){
                    echo '<li><a href="'.$blogBaseUrl .'/_o123game"> خروج </a></li>';
                }else{
                    echo '<li><a href="'.$blogBaseUrl .'/_l123game"> <span><b> ورود </b> </span></a></li>'; 
                }?>
            </ul>
        </div>     
    </div>
</nav>
<div class="container admin_qaccess">
    <div class="admin-nav col-2 col-lg-2 col-md-12" >
                <div class="admin-nav-wrap">
                    <a href="<?php echo $blogBaseUrl;?>/_p123" >
                        <p class="admin-nav-text"> پیشخوان </p>
                    </a>
                </div>
    </div>
    <div class="admin-nav col-2 col-lg-2 col-md-12" >
                <div class="admin-nav-wrap">
                    <a href="<?php echo $blogBaseUrl;?>/_p123/eques"  >
                        <p class="admin-nav-text">مدیریت سوالات</p>
                    </a>
                </div>
    </div>
    <?php 
        if($user_state['logged_role'] == 10 ){?>

            <div class="admin-nav col-2 col-lg-2 col-md-12" >
                <div class="admin-nav-wrap">
                    <p class="admin-nav-text">مدیریت جوایز</p>
                    <ul class="admin-nav-submenu-wrap">
                        <li>
                            <a href="<?php echo $blogBaseUrl;?>/_p123/eaward">
                                مدیریت هدایا
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $blogBaseUrl;?>/_p123/edisc">
                                مدیریت کدهای تخفیف
                            </a>
                        </li>
                    </ul>
                </div>   
            </div>
            <div class="admin-nav col-2 col-lg-2 col-md-12" >
                <div class="admin-nav-wrap">
                    <a href="<?php echo $blogBaseUrl;?>/_p123/lplayer" >
                        <p class="admin-nav-text"> شرکت کننده ها </p>
                    </a>
                </div>
            </div>
            <div class="admin-nav col-2 col-lg-2 col-md-12" >
                <div class="admin-nav-wrap">
                    <a href="<?php echo $blogBaseUrl;?>/_p123/lgame" >
                        <p class="admin-nav-text"> گزارش بازی ها </p>
                    </a>
                </div>
            </div>
            <?php
        }?>


</div>

