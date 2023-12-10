<?php
class Orders {
    public function showAllOrders($conn) {
        $sql = "select o.orderID, o.orderDate, o.status, o.userID, p.productID, o.totalAmount, a.email, a.address, p.productName, od.quantity, p.unitPrice FROM orderdetails od INNER JOIN orders o ON od.orderID = o.orderID INNER JOIN products p ON od.productID = p.productID INNER JOIN account a ON o.userID = a.userID";
        return mysqli_query($conn, $sql);
    }
    
    public function showConfirmationOrder($conn) {
        $sql = "select o.orderID, o.orderDate, o.status, o.userID, p.productID, o.totalAmount, a.email, a.address, p.productName, od.quantity, p.unitPrice, o.note FROM orderdetails od INNER JOIN orders o ON od.orderID = o.orderID INNER JOIN products p ON od.productID = p.productID INNER JOIN account a ON o.userID = a.userID WHERE o.status = 'Waiting for confirmation'";
        return mysqli_query($conn, $sql);
    }
    
    public function showOrdered($conn) {
        $sql = "select o.orderID, o.orderDate, o.status, o.userID, p.productID, o.totalAmount, a.email, a.address, p.productName, od.quantity, p.unitPrice, o.note FROM orderdetails od INNER JOIN orders o ON od.orderID = o.orderID INNER JOIN products p ON od.productID = p.productID INNER JOIN account a ON o.userID = a.userID WHERE o.status = 'Confirmed'";
        return mysqli_query($conn, $sql);
    }
    
    public function setConfirmation($conn, $orderID) {
        $sql = "UPDATE orders SET status = 'Confirmed' WHERE orderID = ?";
        $stmt = $conn->prepare($sql) or die($this->$conn->error.__LINE__);
        $stmt->bind_param("i", $orderID);
        $result = $stmt->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }
    
    public function denyConfirmation($conn, $orderID) {
        $sql = "UPDATE orders SET status = 'Denied' WHERE orderID = ?";
        $stmt = $conn->prepare($sql) or die($this->$conn->error.__LINE__);
        $stmt->bind_param("i", $orderID);
        $result = $stmt->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }
    
    public function setDelivery($conn, $orderID) {
        $sql = "UPDATE orders SET status = 'Delivered' WHERE orderID = ?";
        $stmt = $conn->prepare($sql) or die($this->$conn->error.__LINE__);
        $stmt->bind_param("i", $orderID);
        $result = $stmt->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }
    
    public function findConfirmationOrders($conn, $keyword) {
        $sql = "select o.orderID, o.orderDate, o.status, o.userID, p.productID, o.totalAmount, a.email, a.address, p.productName, od.quantity, p.unitPrice, o.note FROM orderdetails od INNER JOIN orders o ON od.orderID = o.orderID INNER JOIN products p ON od.productID = p.productID INNER JOIN account a ON o.userID = a.userID WHERE o.status = 'Waiting for confirmation' and o.orderDate LIKE '%$keyword%'";
        return mysqli_query($conn, $sql);
    }
    
    public function findOrdered($conn, $keyword) {
        $sql = "select o.orderID, o.orderDate, o.status, o.userID, p.productID, o.totalAmount, a.email, a.address, p.productName, od.quantity, p.unitPrice, o.note FROM orderdetails od INNER JOIN orders o ON od.orderID = o.orderID INNER JOIN products p ON od.productID = p.productID INNER JOIN account a ON o.userID = a.userID WHERE o.status = 'Confirmed' and o.orderDate LIKE '%$keyword%'";
        return mysqli_query($conn, $sql);
    }
    
    public function userOrdered($conn, $userID) {
        $sql = "SELECT p.productID, productName, unitPrice, quantity, totalAmount, status, orderDate FROM orderdetails od INNER JOIN orders o ON od.orderID = o.orderID INNER JOIN products p ON od.productID = p.productID INNER JOIN account a ON o.userID = a.userID WHERE o.userID = '$userID' and status = 'Delivered'";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
    
    public function showUserOrder($conn, $userID) {
        $sql = "SELECT p.productID, productName, unitPrice, quantity, totalAmount, status, orderDate FROM orderdetails od INNER JOIN orders o ON od.orderID = o.orderID INNER JOIN products p ON od.productID = p.productID INNER JOIN account a ON o.userID = a.userID WHERE o.userID = '$userID'";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}
