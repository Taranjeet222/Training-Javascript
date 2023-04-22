<?php
define('SECRET_KEY', 'mysecretkey');
class User {
  static public function RegisterUser($conn,$tablename,$fullname,$username,$phone_number,$age,$email,$user_password){
    $sql = "INSERT INTO $tablename (fullname,username,phone_number,age,email,user_password) VALUES (?,?,?,?,?,?)";
    try {
        $stmt = $conn->prepare($sql);
        $user_pass = $user_password;
        $user_pass = password_hash($user_pass,PASSWORD_DEFAULT);
        $stmt->execute([$fullname, $username, $phone_number, $age, $email, $user_pass]);
        self::login($username,$user_password,$conn,$tablename);
    } catch(PDOException $e) {
        return "Error: " . $e->getMessage();
    }
  }
  static public function DeleteUser($conn,$username,$tablename,){
    $sql = "DELETE FROM $tablename WHERE username=:username";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        self::logout();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
  static public function getUserInfo($conn,$username,$tablename){
    $sql = "SELECT * FROM $tablename WHERE username=:username";
    try{
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":username", $username);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $result['user_password'] = $_SESSION['password'];
      return $result;
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage(); 
    }
  }
  static public function updateUserInfo($conn,$tablename,$username,$column,$new_value){
    $sql = "UPDATE $tablename SET $column=:new_value WHERE username=:username";
    try {
      $stmt = $conn->prepare($sql);
      if($column==='user_password'){
        $_SESSION['password'] = $new_value;
        $new_value = password_hash($new_value,PASSWORD_DEFAULT);
      }
      $stmt->bindParam(":new_value", $new_value);
      $stmt->bindParam(":username", $username);
      $stmt->execute();
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  static public function login($username,$password,$conn,$tablename){
    $sql = "SELECT * FROM $tablename WHERE username=:username";
    try{
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && password_verify($password, $result['user_password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['tablename'] = $tablename;
            $_SESSION['password'] = $password;
            echo "<script>User logged in successfully</script>";
        } else {
            echo "<script>Invalid username or password</script>";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
  }
  
  static public function logout(){
    echo "unsetting";
    setcookie('value','',time()-3600,'/', '', false, false);
    unset($_SESSION['username']);
    unset($_SESSION['tablename']);
  }
}
  
  
  
?>