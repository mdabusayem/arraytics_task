<?php

class SubmissionModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function insertSubmission($data)
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare(
                "INSERT INTO submissions 
                (amount, buyer, receipt_id, items, buyer_email, buyer_ip, note, city, phone, hash_key, entry_at, entry_by) 
                VALUES 
                (:amount, :buyer, :receipt_id, :items, :buyer_email, :buyer_ip, :note, :city, :phone, :hash_key, :entry_at, :entry_by)"
            );

            $stmt->bindParam(':amount', $data['amount'], PDO::PARAM_INT);
            $stmt->bindParam(':buyer', $data['buyer'], PDO::PARAM_STR);
            $stmt->bindParam(':receipt_id', $data['receipt_id'], PDO::PARAM_STR);
            $stmt->bindParam(':items', $data['items'], PDO::PARAM_STR);
            $stmt->bindParam(':buyer_email', $data['buyer_email'], PDO::PARAM_STR);
            $stmt->bindParam(':buyer_ip', $data['buyer_ip'], PDO::PARAM_STR);
            $stmt->bindParam(':note', $data['note'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $data['city'], PDO::PARAM_STR);
            $stmt->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
            $stmt->bindParam(':hash_key', $data['hash_key'], PDO::PARAM_STR);
            $stmt->bindParam(':entry_at', $data['entry_at'], PDO::PARAM_STR);
            $stmt->bindParam(':entry_by', $data['entry_by'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getSubmissions()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM submissions orderBy ORDER BY id DESC");
            $stmt->execute();
            print_r(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
        } catch (PDOException $e) {
            return [];
        }
    }
    public function getFilteredSubmissions($startDate, $endDate, $userId)
{
    $sql = "SELECT * FROM submissions WHERE 1";
    //echo($startDate);
    $sql1='';
    if (!empty($startDate)) {
        $sql1 .= " AND entry_at >= :startDate";
    }
    
    if (!empty($endDate)) {
        $sql1 .= " AND entry_at <= :endDate";
    }
    
    if (!empty($userId)) {
        $sql1 .= " AND entry_by = :userId";
    }
    $order=" ORDER BY id DESC";
    $sql1.=$order;
    $sql.=$sql1;
    
    $stmt = $this->db->prepare($sql);

    if (!empty($startDate)) {
        $stmt->bindParam(':startDate', $startDate);
    }
    
    if (!empty($endDate)) {
        $stmt->bindParam(':endDate', $endDate);
    }
    
    if (!empty($userId)) {
        $stmt->bindParam(':userId', $userId);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}