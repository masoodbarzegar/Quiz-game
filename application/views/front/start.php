<body id="start">
  	
	<div class="container">
    <div class="row">
	    <div class="col-lg-3 hiden">

	    </div>
        <div class="col-lg-6 col-md-12 loginform-div">
	        <div class="login-form">
		        <div class="card-header bordered">
		            <img src="https://oxinchannel.com/wp-content/uploads/2018/03/oxinup-logo1.png" alt="Oxinup Logo" class="oxinup-logo">
		        </div>
		        <div class="card-body">
	            <div class="card-title">
	            </div>
	            
	            <div class="card-text">
	                <p class="bazikon">بازی کن و سکه طلا ببر</p>
	                <p>توی این مسابقه 100 ثانیه وقت داری تا به سؤالهایی که ازت پرسیده میشه جواب بدی و مرحله به مرحله جایزه بزرگتری بدست بیاری.</p>
	                <p>
	                	یادت باشه که میتونی حداکثر 2 تا پاسخ اشتباه داشته باشی وگرنه بازی رو میبازی!

	                </p>
	            <div>
	                <?php
	              	echo form_open('', 'id="startform" class="login-form-entry"');?>
	                    <div class="form-group form-group-custom">
		                    <?php
							    $player_mob_arg = array (
							    	'id'    => 'player_mob',
							    	'type'  => 'number',
							    	'name'  => 'player_mob',
							    	'class' => 'form-control mobile-input',
							    	'placeholder' => '9xxxxxxxxx',
							    	'value' => '' 
							    );
							    echo form_input($player_mob_arg);
							?>
		                    <?php
							    $player_email_arg = array (
							    	'id'=>  'player_email',
							    	'type'  => 'email',
							    	'name' => 'player_email',
							    	'class' => 'form-control email-input',
							    	'placeholder' => 'Email',
							    	'value' => '' 
							    );
							    echo form_input($player_email_arg);	
							?>	
							<div>
		                    <div class="col-lg-6 col-sm-12 captcha-sec">
		                    	<div class="col-lg-10 col-10" style="display: inline-block;">
		                      	<p id="captImg">
		                        	<?php echo $captchaImg; ?>
		                      	</p>
		                      	</div>
		                      	<div class="col-lg-2 col-2" style="display: inline-block;float: right;margin-top: 13px;">
		                        <a href="javascript:void(0);" class="refreshCaptcha"><img src="<?php echo base_url() .'img/refresh.png';?>" /></a>
		                        </div>
		                    </div>
		                    <div class="col-lg-6 col-sm-12 cpatcha-input-sec" style="margin-bottom: 10px;float: right;">
		                    	<?php
									$captcha_arg = array (
					    				'id'=>  'captcha',
					    				'type'  => 'text',
					    				'name' => 'captcha',
					    				'class' => 'form-control captcha-input',
					    				'placeholder' => 'کد امنیتی',
					    				'value' => '' 
				    				);
				    				echo form_input($captcha_arg);
				    			?>
		                    </div>
		                	</div>
		                    <div class="col-lg-12 col-sm-12 submit-wrap">
							<?php 
			                    $game_submit_arg = array (
				    				'id'=>  'submit',
				    				'name' => 'submit',
				    				'class' => 'sub1',
				    				'value' =>  'شروع',
				    				'data-target' => '#confirmcode' ,
				    			);
					    		echo form_submit($game_submit_arg);
					    		echo '<img class="refresh-btn" src="'. base_url() . 'img/refresh.png' . '" />';
					    	?>
		                    </div>
	                    </div>
	                <?php   
			    	echo form_close();?>
	              </div>
	            </div>

	        </div>
	    </div>
        <div class="col-lg-3 hiden">

        </div>
    </div>

    <div class="modal fade" id="confirmcode" tabindex="-1" role="dialog" aria-labelledby="confirmcodeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<p id="result"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
