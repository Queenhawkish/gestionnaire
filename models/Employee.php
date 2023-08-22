<?php

class Employee
{
    private int $id;
    private string $lastname;
    private string $firstname;
    private string $email;
    private string $phone;
    private string $password;

    public static function addEmployee($newlastname, $newfirstname, $newphone, $newemail, $newpassword)
    {
        $pdo = Database::getDatabase();

        $sql = 'INSERT INTO `members` (lastname, firstname, email, phone, password)
        VALUES (:lastname, :firstname, :email, :phone, :password)';

        $query = $pdo->prepare($sql);

        $query->bindValue(':lastname', Form::secureData($newlastname), PDO::PARAM_STR);
        $query->bindValue(':firstname', Form::secureData($newfirstname), PDO::PARAM_STR);
        $query->bindValue(':email', Form::secureData($newemail), PDO::PARAM_STR);
        $query->bindValue(':phone', Form::secureData($newphone), PDO::PARAM_STR);
        $query->bindValue(':password', $newpassword, PDO::PARAM_STR); // Attention , si je secure le password , il sera modifier à cause du htmlspecialchars lors de l'injection dans la base de donnée et l'utilisateur ne pourra plus se connecter

        $query->execute();

        return true;
    }

    public static function checkEmail(string $email) : bool
    {
        $pdo = Database::getDatabase();

        $sql = 'SELECT COUNT(*) FROM `members` WHERE `email` = :email';

        $query = $pdo->prepare($sql);

        $query->bindValue(':email', Form::secureData($email), PDO::PARAM_STR);

        $query->execute();

        $query->fetchColumn() == 1 ? $result = true : $result = false;

        return $result;
    }


    public static function checkPassword(string $email, string $password): bool
    {
        try {

            $pdo = Database::getDatabase();

            $sql = 'SELECT * FROM `members` WHERE `email` = :email';

            $query = $pdo->prepare($sql);

            $query->bindValue(':email', Form::secureData($email), PDO::PARAM_STR);

            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $result['password'])) {

                return true;
            } else {

                return false;
            }

        } catch (PDOException $e) {

            echo $e->getMessage();

            return false;
        }
    }

    public static function getEmployee($email)
    {
        $pdo = Database::getDatabase();

        $sql = 'SELECT * FROM `members` WHERE `email` = :email';

        $query = $pdo->prepare($sql);

        $query->bindValue(':email', Form::secureData($email), PDO::PARAM_STR);

        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
