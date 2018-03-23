<?php
$blogBaseUrl = $this->config->item('base_url');
?>
<div class="container-fluid">
	<div class="container">
		<h2 class="admin-title"><?php echo $title; ?></h2>
		<?php echo validation_errors(); ?>

		<?php 
		if($page_edite){
			echo form_open('admin/page_edite/'. $page_data['id']);
		}else{
			echo form_open('admin/page_create');
			$page_data['page_template'] = '';	
		}?>
		    <label for="page_title">Title</label>
		    <?php
		    $page_title_arg = array (
		    	'id'=>  'page_title',
		    	'name' => 'page_title',
		    	'value' => ($page_edite)? $page_data['page_title'] : '' 
		    );
		    echo form_input($page_title_arg);
			echo'<label for="page_tempalate">Tempalate</label>';

		    $page_theme_arg = array(
		    	'name' => 'page_template',
		    	'id' => 'page_template'
		    );
		    echo form_dropdown($page_theme_arg, $templates, $page_data['page_template']); 
		    echo '<br>';
		    echo '<label for="text">Text</label>';
		    $page_content_arg = array (
		    	'id'=>  'page_content',
		    	'name' => 'page_content',
		    	'value' => ($page_edite)? $page_data['page_content'] : '' 
		    );
		    echo form_textarea($page_content_arg);
		    echo '<label for="page_desc">Description meta</label><br>';
		    $page_desc_arg = array (
		    	'id'=>  'page_desc',
		    	'name' => 'page_desc',
		    	'value' => ($page_edite)? $page_desc : '' 
		    );
			echo form_input($page_desc_arg);
					    		    
		    echo '<div id="setting" ></div>';
		    $page_submit_arg = array (
		    	'id'=>  'submit',
		    	'name' => 'submit',
		    	'value' => ($page_edite) ? 'Edite' : 'Create'
		    );
		    echo form_submit($page_submit_arg);
		    echo form_close();?>
	</div>
</div>
<script type="text/javascript">
	<?php if($page_edite){ ?>
		var temp = $('#page_template').val();
		$.ajax({
				type:"POST",
				dataType: 'text',
				url: '<?php echo $blogBaseUrl; ?>/admin/page_ex_opt/' + temp ,
				data:{
					page_edite: true,
					page_id : <?php echo $page_data['id']; ?>
				},
				success:function(data){
					$('#setting').html(data);
				}
		});
	<?php } ?>
	$('#page_template').change(function(){
		var temp_select = $(this).val();
		$.ajax({
			type:"POST",
			dataType: 'text',
			url: '<?php echo $blogBaseUrl ; ?>/admin/page_ex_opt/'+ temp_select,
			beforSend:function(){
				$('#setting').text('');
			},
			success:function(data){
				$('#setting').html(data);
			}
		});
	});
</script>