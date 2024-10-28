<?php

class Validator
{
    public static function validateEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePassword($password): bool
    {
        return strlen($password) >= 7;
    }

    public function validateInput($email, $password, &$errors): bool
    {
        if (!self::validateEmail($email)) {
            $errors['email'] = 'Please provide a valid email address.';
        }

        if (!self::validatePassword($password)) {
            $errors['password'] = 'Please provide a password of at least seven characters.';
        }

        return empty($errors);
    }
}
