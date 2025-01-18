<?php
include_once 'visiteur_heder_page.php'; 

require_once "../controle/sign_in.php";

$error = isset($_SESSION['error']) ? $_SESSION['error'] : [];
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

unset($_SESSION['email']);

unset($_SESSION['error']);?>

<div class="allr_egister">
<h2>Continue your learning</h2>
<form class="register" action="../controle/sign_in.php" method="POST">

<div class="deux">
<label for="">
Email

</label>
<input type="email" name="email" value="<?= $email ?? '' ?>" placeholder="enter your email">
<p><?= $error['emptyy']?? '';?></p> 
<p><?= $error['email']?? '';?></p> 
</div>

<div class="deux">
<label for="">
Password

</label>
<input type="password" name="pwd" placeholder="enter password" >
<p><?= $error['emptyy']?? '';?></p> 
<p><?= $error['pwd']?? '';?></p> 
</div>
<button>Sign in</button>
<p>S'ont have an account <a href="register.php">Register</a></p>
</form>

</div>
    


</body>
</html>