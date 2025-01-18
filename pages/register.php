<?php
include_once 'visiteur_heder_page.php'; 

require_once "../controle/register.php";

$error = isset($_SESSION['error']) ? $_SESSION['error'] : [];
$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

unset($_SESSION['fullname']);
unset($_SESSION['email']);

unset($_SESSION['error']);?>

<div class="allr_egister">
<h2>Regster and start learning</h2>
<form class="register" action="../controle/register.php" method="post">
<div class="deux">
<label for="">
Full Name
</label>
<input type="text" name="fullname" value="<?= $fullname ?? '' ?>" placeholder="enter your name">
<p> <?= $error['empty']?? '';?></p> 
<p><?= $error['used_name']?? '';?></p> 
<p><?= $error['not_vld_flnm']?? '';?></p> 


</div>

<div class="deux">
<label for="">
Email

</label>
<input type="email" name="email" value="<?= $email ?? '' ?>" placeholder="enter your email">
<p><?= $error['empty']?? '';?></p> 
<p><?= $error['used_email']?? '';?></p> 
<p><?= $error['not_vld_eml']?? '';?></p> 
</div>

<div class="deux">
<label for="">
Password

</label>
<input type="password" name="pwd" placeholder="enter password" >
<p><?= $error['empty']?? '';?></p> 
<p><?= $error['not_vld_pwd']?? '';?></p> 
</div>
<select name="role" id="role">
<option value="student">Sudent</option>
<option value="teacher">Teacher</option>
</select>
<button>Register</button>
<p>already have an account <a href="sign_in.php">Sign in</a></p>
</form>

</div>
    


</body>
</html>