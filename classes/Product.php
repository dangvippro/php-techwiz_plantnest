<?php

class Product {
    
    public function showFlowering($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE categoryID = 1";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showNonFlowering($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE categoryID = 2";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showIndoor($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE categoryID = 3";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showOutdoor($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE categoryID = 4";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showSucculents($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE categoryID = 5";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showMedicinal($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE categoryID = 6";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showPots($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE categoryID = 7";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showGardenTools($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE categoryID = 8";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showPesticides($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE categoryID = 9";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showNewProduct($conn) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE unitPrice > 190";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showAll($conn) {
        $sql = "select productID, productName, unitPrice, height, uses, growthHabits, light, water, imageURL, unitsInStock, categoryID from products";
        return mysqli_query($conn, $sql);
    }

    public function productDetails($conn, $productID) {
        $query = "SELECT p.productID, p.productName, p.categoryID, p.growthHabits, p.height, p.imageURL, p.unitPrice, p.light, p.water, p.uses, c.categoryID, c.categoryName FROM products p INNER JOIN Categories c ON p.categoryID = c.categoryID WHERE productID = '$productID'";
        $result = $conn->query($query) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function add($conn, $productName, $unitPrice, $height, $uses, $growthHabits, $light, $water, $imageURL, $unitsInStock, $categoryID) {
        $sql = "insert into products(productName, unitPrice, height, uses, growthHabits, light, water, imageURL, unitsInStock, categoryID) values ('$productName', '$unitPrice', '$height', '$uses', '$growthHabits', '$light', '$water', '$imageURL', '$unitsInStock', '$categoryID')";
        return mysqli_query($conn, $sql);
    }
    
    public function showRelatedProduct($conn, $categoryID) {
        $query = "SELECT p.productID, p.productName, p.categoryID, p.growthHabits, p.height, p.imageURL, p.unitPrice, p.light, p.water, p.uses, c.categoryID, c.categoryName FROM products p INNER JOIN categories c ON p.categoryID = c.categoryID WHERE c.categoryID = $categoryID";
        $result = $conn->query($query) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function edit($conn, $productName, $unitPrice, $height, $uses, $growthHabits, $light, $water, $categoryID, $imageURL, $unitsInStock, $productID) {
        $sql = "UPDATE products SET productName = '$productName', unitPrice = '$unitPrice', height = '$height', uses = '$uses', growthHabits = '$growthHabits', light = '$light', water = '$water', categoryID = '$categoryID', imageURL = '$imageURL', unitsInStock = '$unitsInStock' WHERE productID = '$productID'";
        return mysqli_query($conn, $sql);
    }
    
    public function delete($conn, $productID) {
        $sql = "delete from products where  productID = '$productID'";
        return mysqli_query($conn, $sql);
    }

    public function findElementByID($conn, $productID) {
        $sql = "select * from products where productID = $productID";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        return $result;
    }

    public function findElementByName($conn, $productName) {
        $sql = "select * from products where productName like '%$productName%'";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public function findProductsbyID($conn, $productID) {
        $stmt = $conn->prepare("SELECT productID, productName, categoryID, growthHabits, light, unitPrice, water, imageURL, height, uses, unitsInStock FROM products WHERE productID = ?");
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    
    public function findProducts($conn, $productName, $categoryID) {
        $sql = "SELECT productID, productName, unitPrice, height, uses, growthHabits, light, water, categoryID, imageURL FROM products WHERE productName LIKE '%$productName%' and categoryID = $categoryID";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        $list = array();
        while($row = $result->fetch_assoc()){
            $list[] = $row;
        }
        return $list;
    }
    
    public function countProduct($conn) {
        $sql = "SELECT count(*) FROM products";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function showStock($conn, $categoryID) {
        $sql = "SELECT p.categoryID, c.categoryName, p.productID, p.productName, p.unitsInStock, p.unitPrice FROM products p INNER JOIN categories c ON p.categoryID = c.categoryID WHERE p.categoryID = '$categoryID' and p.unitsInStock > 0";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function countStock($conn, $categoryID) {
        $sql = "SELECT SUM(unitsInStock) as stock FROM products WHERE categoryID = '$categoryID'";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
    public function findStock($conn, $categoryID, $keyword) {
        $sql = "SELECT p.categoryID, c.categoryName, p.productID, p.productName, p.unitsInStock, p.unitPrice FROM products p INNER JOIN categories c ON p.categoryID = c.categoryID WHERE p.categoryID = '$categoryID' and p.unitsInStock > 0 and p.productName LIKE '%$keyword%'";
        $result = $conn->query($sql) or die($this->conn->error.__LINE__);
        return $result;
    }
    
}