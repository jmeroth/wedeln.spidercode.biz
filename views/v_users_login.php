<form method='POST' action='/users/p_login'>

    Email<br>
    <input type='text' name='email'>
    <br><br>

    Password<br>
    <input type='password' name='password'>
    <br><br>

	<?php if($error == 'password_error'): ?>
        <div class='error' style="color: #090; line-height: 1.2">
            Login failed. Please double check your password.
        </div>
        <br>
    <?php endif; ?>


	<?php if($error == 'email_error'): ?>
        <div class='error' style="color: #090; line-height: 1.2">
            Login failed. Please double check your email.
        </div>
        <br>
    <?php endif; ?>

    <input type='submit' value='Log in'>

</form>
