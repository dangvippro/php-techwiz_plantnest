<?php

class Categories {
    
    public function showAllCategories($conn) {
        $query = "SELECT categoryID, categoryName FROM categories";
        $result = $conn->query($query) or die($this->conn->error.__LINE__);
        return $result;
    }
//
//    public function addCategories($conn, $categoryID, $categoryName) {
//        $query = "INSERT INTO categories(categoryID, categoryName) VALUES (?, ?)";
//        $stmt = $conn->prepare($query) or die($this->conn->error.__LINE__);
//        $stmt->bind_param("is", $categoryID, $categoryName);
//        $add_row = $stmt->execute();
//        if ($add_row) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    public function deleteCategories($conn, $categoryID) {
//        $query = "DELETE FROM categories WHERE categoryID = ?";
//        $stmt = $conn->prepare($query) or die($this->conn->error.__LINE__);
//        $stmt->bind_param("i", $categoryID);
//        $delete_row = $stmt->execute();
//        if ($delete_row) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    public function updateCategories($conn, $categoryID, $categoryName, $description) {
//        $query = "UPDATE categories SET categoryName = ? WHERE categoryID= ?";
//        $stmt = $conn->prepare($query);
//        $stmt->bind_param("si", $categoryName, $categoryID);
//        $update_row = $stmt->execute();
//        if ($update_row) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    public function findCategoriesByID($conn, $categoryID) {
//        $stmt = $conn->prepare("SELECT categoryID, categoryName FROM categories WHERE categoryID = ?");
//        $stmt->bind_param("i", $categoryID);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $row = $result->fetch_assoc();
//        return $row;
//    }
//    
//    public function findCategories($conn, $categoryID) {
//        $sql = "SELECT categoryID, categoryName FROM categories WHERE categoryID like '%$categoryID%'";
//        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
//        $list = array();
//        while($row = $result->fetch_assoc()){
//            $list[] = $row;
//        }
//        return $list;
//    }
//    
    public function showAll($conn) {
        $sql = "select categoryID, categoryName from categories";
        return mysqli_query($conn, $sql);
    }
    
    public function add($conn, $categoryName) {
        $sql = "insert into categories(categoryName) values ('$categoryName')";
        return mysqli_query($conn, $sql);
    }
    
    public function edit($conn, $categoryID, $categoryName) {
        $sql = "update categories set categoryName = '$categoryName' where categoryID = '$categoryID'";
        return mysqli_query($conn, $sql);
    }
    
    public function delete($conn, $categoryID) {
        $sql = "delete from categories where  categoryID = '$categoryID'";
        return mysqli_query($conn, $sql);
    }

    public function findElementByID($conn, $categoryID) {
        $sql = "select * from categories where categoryID = $categoryID";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        return $result;
    }
    
    public function findElementByName($conn, $categoryName) {
        $sql = "select * from categories where categoryName like '%$categoryName%'";
        return mysqli_query($conn, $sql);
    }
    
}
