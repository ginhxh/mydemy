<?php 

class User{
    protected $errors=[];
    protected $pdo;
    protected $fullname;
    protected $email;
    protected $pwd;
    protected $role;

public function __construct($pdo)
{
     $this->pdo=$pdo;
    
}
public function empty_faild($fullname,$email,$pwd)
{
    $fullname = trim($fullname); 
    $email = trim($email); 
    $pwd = trim($pwd); 
if(empty($fullname)||empty($email)||empty($pwd)){
$this->errors['empty']='please fill all fildes';
return true;
}else return false;

}
public function empty_fald($email,$pwd)
{
    $email = trim($email); 
    $pwd = trim($pwd); 
if(empty($email)||empty($pwd)){
$this->errors['emptyy']='please fill all fildes';
return true;
}
else return false;

}

public function unique_fullname($fullname){
try{
    $fullname = trim($fullname); 

$query="SELECT username from users where username= :fullname;";
$stmt=$this->pdo->prepare($query);
$stmt->bindParam(':fullname',$fullname);
$stmt->execute();

if($stmt->rowCount()>0){
    $this->errors['used_name']='this fullname is alerdy register';
    return true;
}else{
    return false;
}
}

catch(PDOException $e){
    echo 'failad'.$e->getMessage();
    return false;
}
}
public function unique_email($email){
    $email = trim($email); 

    try{
    $query="SELECT email from users where email= :email;";
    $stmt=$this->pdo->prepare($query);
    $stmt->bindParam(':email',$email);
    $stmt->execute();
    
    if($stmt->rowCount()>0){
        $this->errors['used_email']='this emil is alerdy registered';
        return true;
    }else{
        $this->errors['no_email']='this emil is not found';
        return false;

    }
    }
    
    catch(PDOException $e){
        echo 'failad'.$e->getMessage();
        return false;
    }
    }
public function valid_email($email){
    $email = trim($email); 

if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    return true;
} else{
    $this->errors['not_vld_eml']='please enter valid email';
    return false;
}
}
public function valid_name($fullname){
    $fullname = trim($fullname); 

    $pattern = "/^[A-Za-z]+(?: [A-Za-z]+)?$/";

    if(preg_match($pattern,$fullname)){
        return true;
    } else{
        $this->errors['not_vld_flnm']='please enter your fullname';
        return false;
    }
    }


    public function valid_pwd($pwd){
        $pwd = trim($pwd); 

        $pattern = "/^(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};':\"\\|,.<>\/?`~]).{6,}$/";

        if(preg_match($pattern,$pwd)){
            return true;
        } else{
            $this->errors['not_vld_pwd']='enter passsword continue leters numbers and spicel caracrtiers';
            return false;
        }
        }
 public function getErrors() {
            return $this->errors;
 }

    public function register($fullname,$email,$pwd,$role='student'){
if(!$this->empty_faild($fullname,$email,$pwd)&&!$this->unique_fullname($fullname)&&
!$this->unique_email($email)&&$this->valid_email($email)&&$this->valid_name($fullname)&&
$this->valid_pwd($pwd)
){

    try{
        $pwd_hach=password_hash($pwd,PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, pwd, role) VALUES (:username, :email, :pwd, :role);";
        $stmt=$this->pdo->prepare($query);
$stmt->bindParam(':username',$fullname);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':pwd',$pwd_hach);
$stmt->bindParam(':role',$role);
$stmt->execute();
echo 'register suscful';
    }catch(PDOException $e){
        echo 'failed register'.$e->getMessage();
        
    }



}else{
    return $this->getErrors();
}


    }   
    
public function corect_pwd($email,$pwd){
    try{
$query="SELECT * from users where email=:email;";
$stmt=$this->pdo->prepare($query);
$stmt->bindParam(':email',$email);
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);
if(password_verify($pwd,$result['pwd'])){

    return true;
}else {
    $this->errors['pwd']='password incorect';
    return false;

}
    }
    catch(PDOException $e){
        echo 'fald'.$e->getMessage();


    }
}
public function sign_in($email, $pwd) {
    if ($this->empty_fald($email, $pwd)) {
        return $this->getErrors();
    }
    
    try {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($pwd, $user['pwd'])) {
            session_start();
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'ban' => $user['ban'],
                'suspend' => $user['suspend'],
                'accepted' => $user['accepted'],
                'date_reg' => $user['date_reg'],
                'role' => $user['role']
            ];
            return true; 
        } else {
            $this->errors['pwd'] = 'Incorrect password';
        }
    }
     catch (PDOException $e) {
        echo 'Login failed: ' . $e->getMessage();
    }

    return $this->getErrors();
}


}