<?php
class User {
  static public function RegisterUser($conn,$tablename,$fullname,$username,$phone_number,$age,$email,$user_password){
    $sql = "INSERT INTO $tablename (fullname,username,phone_number,age,email,user_password) VALUES (?,?,?,?,?,?)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fullname, $username, $phone_number, $age, $email, $user_password]);
        self::login($username,$user_password,$conn,$tablename);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
  static public function DeleteUser($conn,$username,$tablename){
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
      $stmt->bindParam(":new_value", $new_value);
      $stmt->bindParam(":username", $username);
      $stmt->execute();
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  static public function login($username,$password,$conn,$tablename){
    $sql = "SELECT * FROM $tablename WHERE username=:username AND user_password=:pass";
    try{
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":username", $username);
      $stmt->bindParam(":pass", $password);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result) {
        $_SESSION['username'] = $username;
        $_SESSION['tablename'] = $tablename;
        echo "<script>User logged in successfully</script>";
      } else {
        echo "<script>Invalid username or password</script>";
      }
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage(); 
    }
  }
  
  static public function logout(){
    unset($_SESSION['username']);
    unset($_SESSION['tablename']);
  }
}
  
  
  
?>