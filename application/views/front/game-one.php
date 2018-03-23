<?php
$blogBaseUrl = $this->config->item('base_url');
?>
<body id="game">
  <div class="container-flush">
    <div class="row no-gutters">
      <div class="col-lg-3 hiden">
      </div>
      <div class="col-lg-6 col-md-12 gameMainSection">
        <div class="container">
          <div class="row header-tops-items no-gutters">
            <div class="col timer">
              <div id="DateCountdown" data-timer="100" style="width: 100%"></div>
            </div>
            <div class="col-6 logo">
              <img src="<?php echo $blogBaseUrl ;?>/img/oxinup-logo2.png" class="logo-img" alt="OxinUplogo">
            </div>
            <div class="col health">
              <img src="<?php echo $blogBaseUrl ;?>/img/heart-on.png" alt="" class="heart heart-1">
              <img src="<?php echo $blogBaseUrl ;?>/img/heart-on.png" alt="" class="heart heart-2">
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-12 question-allparts">
              <img src="<?php echo $blogBaseUrl ;?>/img/lvl-number.png" class="lvl-number" alt="">
              <div class="questionBox">
                <p class="lvl-number-step">1</p>
                <div class="questionPatagraph">
                  <p><?php echo $ques_data['ques_text'];?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <?php  
        echo form_open('', 'id="gameform"');

            echo form_hidden('ques_id' , $ques_id); 
            echo form_hidden('game_id' , $game_id);
                ?>
                <div class="row asnwers-btns-sections asnwers-btns-sections1">
                  <div class="col-lg-6 col-6" style="padding-left: 0px;">
              <?php echo form_radio('c_ans', '1', FALSE,array( 'id' => 'answers-btn1' , 'class' => 'btn answers-btn')); ?>
                      <p id="answers-label-btn1" class="answers-label-btn1 answers-btn" onclick="check1()" onmouseover="addShrinkStyle1()" onmouseout="removeShrinkStyle1()">
                        <?php echo form_label($ques_data['ques_ans1'], 'c_ans'); ?>
                      </p>
                    </div>
                    <div class="col-lg-6 col-6" style="padding-right: 0px;">
                      <?php echo form_radio('c_ans', '2', FALSE,array( 'id' => 'answers-btn2' , 'class' => 'btn answers-btn')); ?>
                      <p id="answers-label-btn2" class="answers-label-btn2 answers-btn" onclick="check2()" onmouseover="addShrinkStyle2()" onmouseout="removeShrinkStyle2()">
                        <?php echo form_label($ques_data['ques_ans2'], 'c_ans'); ?>
                      </p>
                    </div>
                </div>
                <div class="row asnwers-btns-sections">
                  <div class="col-lg-6 col-6" style="padding-left: 0px;">
                      <?php echo form_radio('c_ans', '3', FALSE,array( 'id' => 'answers-btn3' , 'class' => 'btn answers-btn')); ?>
                      <p id="answers-label-btn3" class="answers-label-btn3 answers-btn" onclick="check3()" onmouseover="addShrinkStyle3()" onmouseout="removeShrinkStyle3()">
                        <?php echo form_label($ques_data['ques_ans3'], 'c_ans'); ?>
                      </p>
                    </div>
                    <div class="col-lg-6 col-6" style="padding-right: 0px;">
                      <?php echo form_radio('c_ans', '4', FALSE,array( 'id' => 'answers-btn4' , 'class' => 'btn answers-btn')); ?>

                      <p id="answers-label-btn4" class="answers-label-btn4 answers-btn" onclick="check4()" onmouseover="addShrinkStyle4()" onmouseout="removeShrinkStyle4()">
                <?php echo form_label($ques_data['ques_ans4'], 'c_ans'); ?>
                      </p>
                    </div>
                </div>
                <div class="row">
                  <div class="col-12 nex-question-btn">
                    <?php 
                    $game_submit_arg = array (
                'id'    => 'submitbtnnext',
                'name'  => 'submit',
                'class' => 'btn sub0 sub1',
                'value' => 'Next' 
              );
              echo form_submit($game_submit_arg);
              echo '<img class="refresh-btn" src="'. base_url() . 'img/refresh.png' . '" />';
              ?>
                  </div>
                </div>
                <?php 
            echo form_close();?>
        </div>


        <div class="container-flush emtiaz-section">
          <div class="row  no-gutters">
            <div class="col-12">
              <div class="container-flush prize-list-1">
                <div class="row no-gutters">
                  <div class="col-4">
                  </div>
                  <div class="col-4">

                  </div>
                  <div class="col-4">
                    <img src="<?php echo $blogBaseUrl ;?>/img/gifts/10-hezar.png" alt="" class="gift-ok gift gift-1 gifts-10-hezar prize-main prize-10">
                  </div>
                </div>
              </div>
              <div class="container-flush prize-list-2">
                <div class="row no-gutters">
                  <div class="khate-zire-1">
                    <div class="dayere-emtiyazat">
                      <div class="circle-emtiaz-khamosh circle-4"></div>
                      <div class="circle-emtiaz-khamosh circle-3"></div>
                      <div class="circle-emtiaz-khamosh circle-2"></div>
                      <div class="circle-emtiaz-khamosh circle-1"></div>
                    </div>
                  </div>
                  <div class="col-4 gifimgs">
                    <img src="<?php echo $blogBaseUrl ;?>/img/gifts/40-hezar.png" alt="" class="gift gift-2 gifts-40-hezar prize-main prize-40">
                  </div>
                  <div class="col-4">
                  </div>
                  <div class="col-4">

                  </div>
                </div>
              </div>
              <div class="container-flush prize-list-3">
                <div class="row no-gutters">
                  <div class="khate-zire-2">
                    <div class="dayere-emtiyazat">
                      <div class="circle-emtiaz-khamosh circle-5"></div>
                      <div class="circle-emtiaz-khamosh circle-6"></div>
                      <div class="circle-emtiaz-khamosh circle-7"></div>
                      <div class="circle-emtiaz-khamosh circle-8"></div>
                    </div>
                  </div>
                  <div class="col-4"></div>
                  <div class="col-4">

                  </div>
                  <div class="col-4 gifimgs">
                    <img src="<?php echo $blogBaseUrl ;?>/img/gifts/70-hezar.png" alt="" class="gift gift-3 gifts-70-hezar prize-main prize-70">
                  </div>
                </div>
              </div>
              <div class="container-flush prize-list-4">
                <div class="row no-gutters">
                  <div class="khate-zire-3">
                    <div class="dayere-emtiyazat">
                      <div class="circle-emtiaz-khamosh circle-12"></div>
                      <div class="circle-emtiaz-khamosh circle-11"></div>
                      <div class="circle-emtiaz-khamosh circle-10"></div>
                      <div class="circle-emtiaz-khamosh circle-9"></div>
                    </div>
                  </div>
                  <div class="col-4 gifimgs">
                    <img src="<?php echo $blogBaseUrl ;?>/img/gifts/50-hezar.png" alt="" class="gift gift-4 gifts-50-hezar prize-main prize-50">
                  </div>
                  <div class="col-4">

                  </div>
                  <div class="col-4">

                  </div>
                </div>
              </div>
              <div class="container-flush prize-list-5">
                <div class="row no-gutters">
                  <div class="khate-zire-4">
                    <div class="dayere-emtiyazat">
                      <div class="circle-emtiaz-khamosh circle-13"></div>
                      <div class="circle-emtiaz-khamosh circle-14"></div>
                      <div class="circle-emtiaz-khamosh circle-15"></div>
                      <div class="circle-emtiaz-khamosh circle-16"></div>
                    </div>
                  </div>
                  <div class="col-4">
                  </div>
                  <div class="col-4">

                  </div>
                  <div class="col-4 gifimgs">
                    <img src="<?php echo $blogBaseUrl ;?>/img/gifts/100-hezar.png" alt="" class="gift gift-5 gifts-100-hezar prize-main prize-100">
                  </div>
                </div>
              </div>
              <div class="container-flush prize-list-6">
                <div class="row no-gutters">
                  <div class="khate-zire-5">
                    <div class="dayere-emtiyazat">
                      <div class="circle-emtiaz-khamosh circle-20"></div>
                      <div class="circle-emtiaz-khamosh circle-19"></div>
                      <div class="circle-emtiaz-khamosh circle-18"></div>
                      <div class="circle-emtiaz-khamosh circle-17"></div>
                    </div>
                  </div>
                  <div class="col-4 gifimgs">
                    <img src="<?php echo $blogBaseUrl ;?>/img/gifts/coin.png" alt="" class="gift gift-6 prize-main prize-coin">
                  </div>
                  <div class="col-4">

                  </div>
                  <div class="col-4">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 hiden">
        </div>
        <div class="footer">

        </div>
      </div>
    </div>
  </div>
    <script type="text/javascript">
      $('#gameform #submitbtnnext').click(function(event) {
        //event.preventDefault();
      var user_ans = $('input[name=c_ans]:checked').val();
      var ques_id  = $('input[name=ques_id]').val();
      var game_id  = $('input[name=game_id]').val();
      var ajaxgame = '1';
      var time = $("#DateCountdown").TimeCircles().getTime(); 
      $("#DateCountdown").TimeCircles().stop();

      $('#gameform #submitbtnnext').prop('disabled',true);
      $('#gameform #submitbtnnext').attr('value' ,'');
      $('.refresh-btn').css('opacity',1);

      $.ajax({
        url: "<?php echo base_url('game'); ?>",
        type: 'POST',
        dataType: 'json',
        data: {
          c_ans    : user_ans,
          ques_id  : ques_id,
          game_id  : game_id,
          ajaxgame : ajaxgame,
          ajaxtime : time
        },
        success: function(data) {
          $('#confirmcode').modal({
            backdrop: 'static',   // This disable for click outside event
            keyboard: true        // This for keyboard event
          });
          $('#confirmcode').modal('show');

          var point_id = '.circle-' + data.point; 
          var award_id = '.gift-' + data.award;
          var lost = '.heart-' +  data.game_lost;

          
          if(data.finish){  
            $(window).attr('location','<?php echo $blogBaseUrl ; ?>/game/finish');
          }else{
            $('input[name=ques_id]').val(data.ques_id);
            $(award_id).addClass('gift-ok');
            if(data.playstate){

              $('.questionBox').css('border-color','#28a745');
              $('.questionBox').animate({
                    borderColor: 'red'
                  },1000,function(){

                    $(point_id).removeClass('circle-emtiaz-khamosh').addClass('circle-emtiaz-on');

                    $('.lvl-number-step').html(data.game_step);
                    $('.questionPatagraph p').html(data.question['ques_text']);
                    $('#answers-label-btn1 label').html(data.question['ques_ans1']);
                    $('#answers-label-btn2 label').html(data.question['ques_ans2']);
                    $('#answers-label-btn3 label').html(data.question['ques_ans3']);
                    $('#answers-label-btn4 label').html(data.question['ques_ans4']);

                    $('.questionBox').css('border-color','#fff');
                    $("#DateCountdown").TimeCircles().start();
                    $("#gameform")[0].reset();
                    $('#gameform #submitbtnnext').prop('disabled',false);
                    $('.refresh-btn').css('opacity',0);
                    $('#gameform #submitbtnnext').show(1000);
                    $('#gameform #submitbtnnext').attr('value' ,'Next');
              });

            }else{
              
              $('.questionBox').css('border-color','#8B0000');
              $('.questionBox').animate({

                    borderColor: 'green',

                  },1000,function(){


                    $('.lvl-number-step').html(data.game_step);
                    $('.questionPatagraph p').html(data.question['ques_text']);
                    $('#answers-label-btn1 label').html(data.question['ques_ans1']);
                    $('#answers-label-btn2 label').html(data.question['ques_ans2']);
                    $('#answers-label-btn3 label').html(data.question['ques_ans3']);
                    $('#answers-label-btn4 label').html(data.question['ques_ans4']);

                    $('.questionBox').css('border-color','#fff');

                    $(lost).addClass('heart-off');  
                    if(data.game_lost == 1){
                      $(lost).siblings().addClass('heart-mov');   
                    }else{
                      $('.heart').removeClass('heart-mov');
                    }
                    $("#DateCountdown").TimeCircles().start();
                    $("#gameform")[0].reset();
                    $('#gameform #submitbtnnext').prop('disabled',false);
                    $('.refresh-btn').css('opacity',0);
                    $('#gameform #submitbtnnext').show(1000);
                    $('#gameform #submitbtnnext').attr('value' ,'Next');
              });               
            }
            
            
          }
        }
      });
      return false;
    });
    </script>
