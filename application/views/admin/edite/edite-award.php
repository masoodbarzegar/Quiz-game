<?php
$blogBaseUrl = $this->config->item('base_url');
?>
<div class="container-fluid">
	<div class="container">
		<h2 class="admin-title"><?php echo $title; ?></h2>
		<?php echo validation_errors(); ?>

		<?php 
		if($award_edite){
			echo form_open('_p123/eaward/'. $award_data['award_id']);
		}else{
			echo form_open('_p123/caward');
		}?>

		<label for="award_text">Award Text</label>
		<?php
		    $award_text_arg = array (
		    	'id'=>  'award_text',
		    	'name' => 'award_text',
		    	'value' => ($award_edite)? $award_data['award_text'] : '' 
		    );
	    echo form_input($award_text_arg);
		echo '<br>';

		$award_submit_arg = array (
		    'id'=>  'submit',
		    'name' => 'submit',
		    'value' => ($award_edite) ? 'Edite' : 'Create'
		);
		echo form_submit($award_submit_arg);
		echo form_close();?>
	</div>
</div>
</div>
