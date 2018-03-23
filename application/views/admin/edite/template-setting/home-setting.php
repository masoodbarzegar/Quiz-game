<h4> تنظیمات صفحه </h4>
<?php 
//var_dump($page_setting);

echo '<label for="page_setting[title_r1]">Title of Row one</label>'; 
$input_psethome_texr1 = array(
    'name' => 'page_setting[title_r1]',
    'value' => ($page_edite)? $page_setting['title_r1'] : '' 
);
echo form_input($input_psethome_texr1);

echo '<label for="page_setting[title_r2]">Title of Row one</label>'; 
$input_psethome_texr2 = array(
    'name' => 'page_setting[title_r2]',
    'value' => ($page_edite)? $page_setting['title_r2'] : '' 
);
echo form_input($input_psethome_texr2);

echo '<label for="page_setting[title_r3]">Title of Row one</label>'; 
$input_psethome_texr3 = array(
    'name' => 'page_setting[title_r3]',
    'value' => ($page_edite)? $page_setting['title_r3'] : '' 
);
echo form_input($input_psethome_texr3);
