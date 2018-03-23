<div id="register" class="container-fluid main-content">
    <div class="container">
            <h1 class="page-header">ثبت نام</h1>
            <div class="abstract">
                <?php
                echo validation_errors(); 

                echo form_open('_r123game');
                echo "<label for='disname'> Display Name </label>";
                echo form_input('disname');
                echo "<label for='username'> Username </label>";
                echo form_input('username');
                echo "<label for='email'> Email </label>";
                echo form_input('email');
                echo "<label for='password'> Password </label>";
                echo form_password('password');
                echo "<label for='passconf'> Password Confirmation </label>";
                echo form_password('passconf');
                
                echo '<br>';
                echo form_submit('register','Register');
                
                echo form_close();
                ?>
            </div>
    </div>
</div>
