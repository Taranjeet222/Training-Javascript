<?php
class Validator {
    public static function validateUsername($username) {
        if (!ctype_alnum($username)) {
            return false;
        }

        if (strlen($username) < 4 || strlen($username) > 10) {
            return false;
        }

        return true;
    }

    public static function validateName($name) {
        if (!ctype_alpha(str_replace(' ', '', $name))) {
            return false;
        }

        return true;
    }

    public static function validatePhoneNumber($phone) {
        if (!preg_match('/^(?:(\+91)|(0))?([1-9][0-9]{9})$/', $phone)) {
            return false;
        }

        return true;
    }

    public static function validatePassword($password) {
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{4,20}$/', $password)) {
            return false;
        }

        return true;
    }
    public static function validateConfirmPassword($password,$confirm_password)
    {
        if($password!==$confirm_password){
            return false;
        }
        return true;
    }
    public static function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }
}
?>