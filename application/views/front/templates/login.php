<div id="login" class="container-fluid main-content">
    <div class="container">
            <h1 class="page-header"><?php echo $title;?></h1>
            <div class="abstract">
                <?php
                echo validation_errors(); 
                echo form_open('/_l123game');

                echo "<label for='username'> Username </label>";
                echo form_input('username');
                echo "<label for='password'> Password </label>";
                echo form_password('password');
            
                echo '<br>';
                echo form_submit('login','Login');
                
                echo form_close();
                ?>
            </div>

    </div>
</div>
