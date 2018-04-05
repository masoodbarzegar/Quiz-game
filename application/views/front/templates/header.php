<!DOCTYPE html>
<html>
<head>
    <?php
    $blogBaseUrl = $this->config->item('base_url');
    ?>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo (isset($page_desc))? $page_desc : 'زبان انگلیسی خود را بسنجید و سکه طلا جایزه بگیرید';?>">
    <link rel="shortcut icon" href="https://oxinchannel.com/wp-content/uploads/2017/10/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo $blogBaseUrl; ?>/css/front-v26.css" media="all" >
    <link rel="stylesheet" type="text/css" href="<?php echo $blogBaseUrl; ?>/css/hover.css" media="all" >


    <script src="<?php echo $blogBaseUrl; ?>/js/jquery.js"></script>
    <!--script src="<?php //echo $blogBaseUrl; ?>/js/moment.js" ></script-->
    <script type="text/javascript" src="<?php echo $blogBaseUrl ;?>/js/timecircles.js"></script>
<!— Global site tag (gtag.js) - Google Analytics —>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81897409-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-81897409-1');
</script>
</head>
