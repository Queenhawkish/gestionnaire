<?php 

class Type{
    private int $id;
    private string $reasons;
    private int $tva;

    public static function getAllTypes(){
        $db = Database::getDatabase();
        $sql = "SELECT * FROM `reasons`";
        $query = $db->query($sql);
        $types = $query->fetchAll(PDO::FETCH_ASSOC);

        return $types;
    }
}