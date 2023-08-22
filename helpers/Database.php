<?php

class Database{
    public static function getDatabase(){
        $dbh = 'mysql:host='. HOST .';dbname=' . DATABASE . ';charset=utf8mb4';
        try {
            $pdo = new PDO($dbh, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}