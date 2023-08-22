<?php

class Cost
{
    private int $id_cost;
    private int $id_Members;
    private int $id_Reasons;
    private string $cost_date;
    private float $amount_ht;
    private float $amount_ttc;
    private string $motive_cost;
    private string $proof_name;
    private string $proof_base64;
    private int $dec_id;
    private string $decision_date;
    private string $reason_decision;


    public static function getAllCosts()
    {
        $db = Database::getDatabase();
        $sql = "SELECT 
                    *
                FROM
                    `cost`
                        INNER JOIN
                    `reasons` ON id_Reasons = `reasons`.id
                        INNER JOIN 
                    `decisions` ON `cost`.dec_id = `decisions`.id
                    ORDER BY cost_date";
        $query = $db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function addCost($cost_date, $amount_ht, $amount_ttc, $proof_base64, $proof_name, $id_Members, $id_Reasons, $motive_cost): bool
    {
        try {
            $db = Database::getDatabase();

            $sql = "INSERT INTO `cost` 
                    (cost_date, 
                    amount_ht, 
                    amount_ttc, 
                    proof_base64, 
                    proof_name, 
                    id_Members, 
                    id_Reasons, 
                    motive_cost) 
                    VALUES 
                    (:cost_date, 
                    :amount_ht, 
                    :amount_ttc, 
                    :proof_base64, 
                    :proof_name, 
                    :id_Members, 
                    :id_Reasons, 
                    :motive_cost)";

            $query = $db->prepare($sql);

            $query->bindValue(':cost_date', Form::secureData($cost_date), PDO::PARAM_STR);
            $query->bindValue(':amount_ht', Form::secureData($amount_ht), PDO::PARAM_STR);
            $query->bindValue(':amount_ttc', Form::secureData($amount_ttc), PDO::PARAM_STR);
            $query->bindValue(':proof_base64', $proof_base64, PDO::PARAM_STR);
            $query->bindValue(':proof_name', Form::secureData($proof_name), PDO::PARAM_STR);
            $query->bindValue(':id_Members', Form::secureData($id_Members), PDO::PARAM_INT);
            $query->bindValue(':id_Reasons', Form::secureData($id_Reasons), PDO::PARAM_INT);
            $query->bindValue(':motive_cost', Form::secureData($motive_cost), PDO::PARAM_STR);

            return $query->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    public static function getCostById(int $id_members)
    {
        $db = Database::getDatabase();
        $sql = "SELECT 
                    *
                FROM
                    `cost`
                        right JOIN
                    `reasons` ON id_Reasons = `reasons`.id
                        left join 
                    `decisions` on `cost`.dec_id = `decisions`.id
                WHERE
                    id_Members = :id_Members";
        $query = $db->prepare($sql);
        $query->bindValue(':id_Members', $id_members, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function deleteCostById(int $id_cost)
    {
        $db = Database::getDatabase();
        $sql = "DELETE FROM `cost` WHERE id_cost = :id_cost";
        $query = $db->prepare($sql);
        $query->bindValue(':id_cost', $id_cost, PDO::PARAM_INT);
        return $query->execute();
    }

    public static function getCostByIdCost(int $id_cost)
    {
        $db = Database::getDatabase();
        $sql = "SELECT 
                    *
                FROM
                    `cost`
                        right JOIN
                    `reasons` ON id_Reasons = `reasons`.id
                        left join 
                    `decisions` on `cost`.dec_id = `decisions`.id
                WHERE
                    id_cost = :id_cost";
        $query = $db->prepare($sql);
        $query->bindValue(':id_cost', $id_cost, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function updateCostEmployee($id, $cost_date, $amount_ht, $amount_ttc, $newproof_base64, $newproof_name, $id_Reasons, $motive_cost){
        try {
            $db = Database::getDatabase();

            $sql = "UPDATE `cost` 
                    SET 
                        `id_Reasons` = :id_Reasons,
                        `cost_date` = :cost_date,
                        `amount_ttc` = :amount_ttc,
                        `amount_ht` = :amount_ht,
                        `motive_cost` = :motive_cost,
                        `proof_name` = :newproof_name,
                        `proof_base64` = :newproof_base64
                    WHERE
                        id_cost = :id_cost;";

            $query = $db->prepare($sql);

            $query->bindValue(':cost_date', Form::secureData($cost_date), PDO::PARAM_STR);
            $query->bindValue(':amount_ht', Form::secureData($amount_ht), PDO::PARAM_STR);
            $query->bindValue(':amount_ttc', Form::secureData($amount_ttc), PDO::PARAM_STR);
            $query->bindValue(':newproof_base64', $newproof_base64, PDO::PARAM_STR);
            $query->bindValue(':newproof_name', Form::secureData($newproof_name), PDO::PARAM_STR);
            $query->bindValue(':id_Reasons', Form::secureData($id_Reasons), PDO::PARAM_INT);
            $query->bindValue(':motive_cost', Form::secureData($motive_cost), PDO::PARAM_STR);
            $query->bindValue(':id_cost', $id, PDO::PARAM_INT);

            return $query->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    public static function updateCostDecision($id, $id_decisions, $decision_date, $reason_decision)
    {
        try {
            $db = Database::getDatabase();

            $sql = "UPDATE `cost` 
            SET 
                `dec_id` = :id_decisions,
                `decision_date` = :decision_date,
                `reason_decision` = :reason_decision
            WHERE
                id_cost = :id_cost;";

            $query = $db->prepare($sql);

            $query->bindValue(':id_decisions', Form::secureData($id_decisions), PDO::PARAM_INT);
            $query->bindValue(':decision_date', Form::secureData($decision_date), PDO::PARAM_STR);
            $query->bindValue(':reason_decision', Form::secureData($reason_decision), PDO::PARAM_STR);
            $query->bindValue(':id_cost', $id, PDO::PARAM_INT);

            return $query->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }
}
