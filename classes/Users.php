<?php 

    function checkuser($conn, $id, $pass){
        $query = "SELECT userID, fullname, phone, address, gender, role, password, email, birthday FROM account WHERE userID = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $id, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if($result->num_rows > 0){
            return $row['role'];
        } else {
            return null;
        }
        
    }
    function getUserInfo($conn, $id){
        $sql = "SELECT userID, fullname, phone, address, gender, role, password, email, birthday FROM account WHERE userID = '$id'";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    function showUser($conn) {
        $sql = "SELECT userID, fullname, phone, address, gender, role, password, email, birthday FROM account WHERE role = 0";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    function insertUser($conn, $userid, $fullname, $email, $phone, $address, $password, $role, $gender, $birthday) {
        $query = "INSERT INTO account(userID, fullname, email, phone, address, password, role, gender, birthday) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssiss", $userid, $fullname, $email, $phone, $address, $password, $role, $gender, $birthday);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    function updateAccount($conn, $userid, $fullname, $phone, $email, $address, $birthday, $gender) {
        $query = "UPDATE account SET fullname = ?, phone = ?, email= ?, address = ?, birthday = ?, gender = ? WHERE userID= ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", $fullname, $phone, $email, $address, $birthday, $gender, $userid);
        $update_row = $stmt->execute();
        if ($update_row) {
            return true;
        } else {
            return false;
        }
    }
    function deleteAccount($conn, $userid) {
        $query = "DELETE FROM account WHERE userID = ?";
        $stmt = $conn->prepare($query) or die($this->conn->error.__LINE__);
        $stmt->bind_param("s", $userid);
        $delete_row = $stmt->execute();
        if ($delete_row) {
            return true;
        } else {
            return false;
        }
    }
    function deleteAccountOrder($conn, $userid) {
        $query = "DELETE FROM orders WHERE userID = ?";
        $stmt = $conn->prepare($query) or die($this->conn->error.__LINE__);
        $stmt->bind_param("s", $userid);
        $delete_row = $stmt->execute();
        if ($delete_row) {
            return true;
        } else {
            return false;
        }
    }
    function deleteAccountReview($conn, $userid) {
        $query = "DELETE FROM userreview WHERE userID = ?";
        $stmt = $conn->prepare($query) or die($this->conn->error.__LINE__);
        $stmt->bind_param("s", $userid);
        $delete_row = $stmt->execute();
        if ($delete_row) {
            return true;
        } else {
            return false;
        }
    }
    function updatePassword($conn, $userid, $password) {
        $query = "UPDATE account SET password = ? WHERE userID= ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $password, $userid);
        $update_row = $stmt->execute();
        if ($update_row) {
            return true;
        } else {
            return false;
        }
    }
    
    function countAccountUser($conn) {
        $sql = "SELECT count(*) FROM account WHERE role = 0";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }