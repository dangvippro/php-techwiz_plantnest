<?php

class UserReview {
    public function showAll($conn) {
        $sql = "SELECT reviewNo, u.userID, rating, review, seen, dateReview, u.productID, p.productName, p.unitPrice, a.fullname, a.email FROM userreview u INNER JOIN products p ON u.productID = p.productID INNER JOIN account a ON u.userID = a.userID WHERE seen = 0";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function findReview($conn, $keyword) {
        $sql = "SELECT reviewNo, u.userID, u.rating, review, seen, dateReview, u.productID, p.productName, p.unitPrice, a.fullname, a.email FROM userreview u INNER JOIN products p ON u.productID = p.productID INNER JOIN account a ON u.userID = a.userID WHERE u.rating LIKE '$keyword%' or p.productName LIKE '$keyword%' or a.fullname LIKE '%$keyword%'";
        return mysqli_query($conn, $sql);
    }
    
    public function updateSeen($conn, $reviewNo) {
        $sql = "UPDATE userreview SET seen = 1 WHERE reviewNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $reviewNo);
        $update = $stmt->execute();
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteReview($conn, $reviewNo) {
        $sql = "DELETE FROM userreview WHERE reviewNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $reviewNo);
        $delete = $stmt->execute();
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }
    
    public function addReview($conn, $userID, $rating, $review, $productID) {
        $sql = "INSERT INTO userreview(userID, rating, review, productID) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $userID, $rating, $review, $productID);
        $insert = $stmt->execute();
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }
}
