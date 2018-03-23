<?php
$blogBaseUrl = $this->config->item('base_url');
echo '<p>کاربر گرامی، یک کد یکبار مصرف برای شماره موبایل شما پیامک شده است، لطفاً این کد را در کادر زیر وارد و سپس تایید کنید.</p>';
?>
<form action="" id="confirmform" >
<?php
	    echo '<div class="form-group form-group-custom">';
			$confirm_code_arg = array (
				'id'    => 'confirm_code',
				'type'  => 'text',
				'name'  => 'confirm_code',
				'class' => 'form-control email-input',
				'placeholder' => 'کد ارسال شده را اینجا وارد کنید',
				'value' => '' 
			);
			echo form_input($confirm_code_arg);
	        $game_submit_arg = array (
		    	'id'=>  'submit',
		    	'name' => 'submit',
		    	'class' => 'sub1',
		    	'value' =>  'تایید کد'
		    );
		    
			echo form_submit($game_submit_arg);
	echo '</div>';
echo form_close();
echo '<p id="aaaa"></p>';
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#confirmform #submit').click(function() {
			var confirm_codes   = $('#confirm_code').val();
			var ajax = '1';

					console.log('confirm_code');
					var aa = $('#result').html();
					//$('#confirmcode').modal('hide');
					$.ajax({
						url: "<?php echo base_url('game/login'); ?>",
						type: 'POST',
						dataType: 'json',
						data: {
							confirm_code : confirm_codes,
							confirm_ajax : ajax
						},
						success: function(data) {
							console.log(data);
							if(data.confirmstate){

								$('#aaaa').html(data.confirmmsg);
								console.log(data.confirmmsg);
								$('#confirmcode').modal('hide');
								$(window).attr('location','<?php echo $blogBaseUrl ; ?>/game')
							}else{
								$('#aaaa').html(data.confirmmsg);
								console.log(data.confirmmsg);
							}
						}
					});
					$('#confirmcode').modal('show');
					console.log('form_data_e');
					return false;
		});

	});
</script>
	   
    

