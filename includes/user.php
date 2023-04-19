<?php
class User {
  static public function RegisterUser($conn,$tablename,$fullname,$username,$phone_number,$age,$email,$user_password){
    $sql = "INSERT INTO $tablename (fullname,username,phone_number,age,email,user_password) VALUES (?,?,?,?,?,?)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->exec([$fullname, $username, $phone_number, $age, $email, $user_password]);
        echo "New User created successfully";
        self::login($username,$tablename);
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
      echo "User info updated successfully";
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  static public function login($username,$tablename){
    $_SESSION['username'] = $username;
    // $_SESSION['conn'] = $conn;
    $_SESSION['tablename'] = $tablename;
    echo "User logged in successfully";
  }
  
  static public function logout(){
    unset($_SESSION['username']);
    unset($_SESSION['tablename']);
    echo "User logged out successfully";
  }
}
  
  
  
?>