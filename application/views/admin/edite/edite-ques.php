<?php
$blogBaseUrl = $this->config->item('base_url');
?>
<div class="container-fluid">
	<div class="container">
		<h2 class="admin-title"><?php echo $title; ?></h2>
		<?php echo validation_errors(); ?>

		<?php 
		if($ques_edite){
			echo form_open('_p123/eques/'. $ques_data['ques_id']);
		}else{
			echo form_open('_p123/cques');
			$ques_data['ques_level'] = '';	
			$ques_data['c_ans'] = '';
		}?>

		<label for="ques_text">Question</label>
		<?php
		    $ques_title_arg = array (
		    	'id'=>  'ques_text',
		    	'name' => 'ques_text',
		    	'value' => ($ques_edite)? $ques_data['ques_text'] : '' 
		    );
	    echo form_input($ques_title_arg);
		echo '<br>';?>

		<label class="ques_ans" for="ques_ans1">Option one</label>
		<?php
		    $ques_ans1_arg = array (
		    	'id'=>  'ques_ans1',
		    	'name' => 'ques_ans1',
		    	'class' => 'ques_ans',
		    	'value' => ($ques_edite)? $ques_data['ques_ans1'] : '' 
		    );
		    echo form_input($ques_ans1_arg);
			echo '<br>';?>
		<label class="ques_ans" for="ques_ans2">Option two</label>
		<?php
		    $ques_ans2_arg = array (
		    	'id'=>  'ques_ans2',
		    	'name' => 'ques_ans2',
		    	'class' => 'ques_ans',
		    	'value' => ($ques_edite)? $ques_data['ques_ans2'] : '' 
		    );
		    echo form_input($ques_ans2_arg);
			echo '<br>';?>
		<label class="ques_ans" for="ques_ans3">Option three</label>
		<?php
		    $ques_ans3_arg = array (
		    	'id'=>  'ques_ans3',
		    	'name' => 'ques_ans3',
		    	'class' => 'ques_ans',
		    	'value' => ($ques_edite)? $ques_data['ques_ans3'] : '' 
		    );
		    echo form_input($ques_ans3_arg);
			echo '<br>';?>
		<label class="ques_ans" for="ques_ans4">Option four</label>
		<?php
		    $ques_ans4_arg = array (
		    	'id'=>  'ques_ans4',
		    	'name' => 'ques_ans4',
		    	'class' => 'ques_ans',
		    	'value' => ($ques_edite)? $ques_data['ques_ans4'] : '' 
		    );
		    echo form_input($ques_ans4_arg);
			echo '<br>';?>

		<label class="ques_level" for="ques_level">Question Level</label>
		    <?php
		    $ques_level_arg = array(
		    	'name' => 'ques_level',
		    	'id' => 'ques_level'
		    );
		    $ques_level_items = array( '' => '----' ,1 => 1 , 2 => 2 , 3 => 3 , 4 => 4 , 5 => 5 );
		    echo form_dropdown($ques_level_arg, $ques_level_items, $ques_data['ques_level']); 
 			echo '<br>';?>

			<label class="c_ans" for="c_ans">Answer of Question</label>		
		    <?php
		    $c_ans_arg = array(
		    	'name' => 'c_ans',
		    	'id' => 'c_ans'
		    );
		    //var_dump($ans_data);

		    $c_ans_items = array( '' => '----' ,1 => 1 , 2 => 2 , 3 => 3 , 4 => 4 );
		    echo form_dropdown($c_ans_arg, $c_ans_items, $ques_data['c_ans']); 
		    echo '<br>';

		    $ques_submit_arg = array (
		    	'id'=>  'submit',
		    	'name' => 'submit',
		    	'value' => ($ques_edite) ? 'Edite' : 'Create'
		    );
		    echo form_submit($ques_submit_arg);
		    echo form_close();?>
	</div>
</div>
