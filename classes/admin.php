<?php
require_once 'user.php';

class Admin extends User {

    public function __construct($pdo) {
        parent::__construct($pdo);
    }

    public function get_all_users() {
        try {
            $query = "SELECT * FROM users";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching users: " . $e->getMessage();
            return [];
        }
    }

   
}
?>
