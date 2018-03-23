<?php
$blogBaseUrl = $this->config->item('base_url');
?>
<div class="container-fluid">
	<div class="container">
		<h2 class="admin-title"><?php echo $title; ?></h2>
		<?php echo validation_errors(); ?>

		<?php 
		if($discont_edite){
			echo form_open('_p123/edisc/'. $disc_data['discont_id']);
		}else{
			echo form_open('_p123/cdisc');
			$disc_data['award_id'] = '';
		}?>

		<label for="discont_code">Discount</label>
		<?php
		    $discont_code_arg = array (
		    	'id'=>  'discont_code',
		    	'name' => 'discont_code',
		    	'value' => ($discont_edite)? $disc_data['discont_code'] : '' 
		    );
	    echo form_input($discont_code_arg);
	    echo '<br>';

	    echo'<label for="award_id">Award ID</label>';
	    //var_dump($form_award_list);
		$award_text_arg = array(
		  	'name' => 'award_text',
		   	'id' => 'award_id'
		);
		echo form_dropdown($award_text_arg, $form_award_list, $disc_data['award_id']); 

		echo '<br>';
		$disc_submit_arg = array (
		    'id'=>  'submit',
		    'name' => 'submit',
		    'value' => ($discont_edite) ? 'Edite' : 'Create'
		);
		echo form_submit($disc_submit_arg);
		echo form_close();?>
	</div>
</div>
</div>
