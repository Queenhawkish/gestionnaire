<?php


class Manager 
{
    private int $id;
    private string $email;
    private string $password;

    public static function checkManager(string $email): bool
    {
        try {
            $pdo = Database::getDatabase();

            $sql = 'SELECT COUNT(*) FROM `manager` WHERE `email` = :email';

            $query = $pdo->prepare($sql);

            $query->bindValue(':email', Form::secureData($email), PDO::PARAM_STR);

            $query->execute();

            $query->fetchColumn() == 1 ? $result = true : $result = false;

            return $result;

        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public static function checkPassword(string $email, string $password): bool
    {
        try {

            $pdo = Database::getDatabase();

            $sql = 'SELECT * FROM `manager` WHERE `email` = :email';

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

    public static function getManager($email)
    {
        $pdo = Database::getDatabase();

        $sql = 'SELECT * FROM `manager` WHERE `email` = :email';

        $query = $pdo->prepare($sql);

        $query->bindValue(':email', Form::secureData($email), PDO::PARAM_STR);

        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

}