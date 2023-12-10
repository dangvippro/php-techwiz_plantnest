<?php

class Orderdetails {
    
    public function countSoldQuantity($conn) {
        $sql = "SELECT sum(quantity) FROM `orderdetails`;";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showSoldQuantity($conn) {
        $sql = "SELECT od.productID, od.price, p.productName, SUM(quantity) as soldQuantity, price*SUM(quantity) as total FROM orderDetails od INNER JOIN products p on od.productID = p.productID GROUP BY od.productID;";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function findSoldQuantity($conn, $keyword) {
        $sql = "SELECT od.productID, od.price, p.productName, SUM(quantity) as soldQuantity, price*SUM(quantity) as total FROM orderDetails od INNER JOIN products p on od.productID = p.productID WHERE p.productName like '%$keyword%' GROUP BY od.productID;";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
}
