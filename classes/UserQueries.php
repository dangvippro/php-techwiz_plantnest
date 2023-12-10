<?php

class UserQueries {
    public function insertFeedback($conn, $username, $email, $message) {
        $query = "INSERT INTO userqueries(username, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query) or die($this->conn->error.__LINE__);
        $stmt->bind_param("sss", $username, $email, $message);
        $insert_row = $stmt->execute();
        if ($insert_row) {
            return true;
        } else {
            return false;
        }
    }
    
    public function showAllFeedback($conn) {
        $sql = "SELECT userNo, username, email, message, dateFeedback FROM userqueries";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function findFeedback($conn, $keyword) {
        $sql = "SELECT userNo, username, email, message, dateFeedback FROM userqueries WHERE dateFeedback LIKE '$keyword%'";
        return mysqli_query($conn, $sql);
    }
    
    public function deleteFeedback($conn, $userNo) {
        $sql = "DELETE FROM userqueries WHERE userNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userNo);
        $delete = $stmt->execute();
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }
}