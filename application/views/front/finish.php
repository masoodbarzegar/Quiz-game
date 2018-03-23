<?php
$blogBaseUrl = $this->config->item('base_url');

echo validation_errors(); ?>
<body id="finish">
  
  <div class="container">
    <div class="row">
      <div class="col-lg-3 hiden">
      </div>
      <div class="col-lg-6 col-md-12 gameMainSection">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <img src="<?php echo $blogBaseUrl ;?>/img/motion-game-min.gif" class="winergif" alt="">
            </div>
            <?php if($award['award_id'] < 4){ ?>
              <div class="col-12 winerPrize-code">
                <p class="prize-title-code"> تبریک! </p>
                <p class="prize-title-code">شما برنده <?php echo $award['award_text'];?> <?php echo $award['discont_code'];?>
                شده اید.</p>
                <p class="prizeDesc-code">با این کد می توانید از طریق وب سایت یا اپلیکیشن اکسین چنل در یکی از دوره های آموزشی ثبت نام کنید و سطح زبانتان را تقویت کنید.</p>
                <a href="https://oxinchannel.com/register" role="button" class="btn btn-info backToSite3">همین حالا ثبت نام کنید</a>
              </div>

            <?php }else{ ?>
              <div class="col-12 winerPrize-money">
                <p class="prize-title-money">شما برنده <?php echo $award['award_text'];?> شده اید.</p>
                <p class="prizeDesc-money">همکاران ما بعد از تعطیلات نوروز برای هماهنگی دریافت جایزه با شما تماس خواهند گرفت.</p>
              </div>
            <?php  } ?>
            <div class="container">
              <div class="row">
                
                <div class="col-lg-6 col-12 backToSite">
                  <a href="https://oxinchannel.com/%D8%AF%D8%A7%D9%86%D9%84%D9%88%D8%AF-%D8%A7%D9%BE%D9%84%DB%8C%DA%A9%DB%8C%D8%B4%D9%86-%D8%A7%DA%A9%D8%B3%DB%8C%D9%86-%DA%86%D9%86%D9%84/" role="button" class="btn btn-success backToSite2">دانلود اپلیکیشن اکسین چنل</a>
                </div>
                <div class="col-lg-6 col-12 backToSite">
                  <a onclick="teleShare()" role="button" class="btn btn-success backToSite1">ارسال بازی برای دوستان</a>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-lg-3 hiden">
      </div>
    </div>
  </div>