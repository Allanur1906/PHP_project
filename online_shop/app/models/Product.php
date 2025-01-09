<?php

class Product {
    public static function getAllProduct() {
        global $pdo;

        $sql = "SELECT * 
                FROM products";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($category, $name, $price)
    {
        global $pdo;

        $sql = "INSERT INTO products (name, price, category) 
            VALUES (:name, :price, :category)";

        $stmt = $pdo->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR); // Use PDO::PARAM_STR for float values
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);

        // Execute the query
        if ($stmt->execute()) {
            return $pdo->lastInsertId(); // Return the ID of the newly created product
        } else {
            return false; // Return false if the query failed
        }

    }

    public static function findById($id) {
        global $pdo;
        // Query to check if the product exists in the database
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":id" => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC); // Returns the product if found, otherwise null
    }

    public static function delete($id) {
        global $pdo;
        // Query to delete the product from the database
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(array(":id" => $id)); // Returns true if successful, false otherwise
    }

    public static function update($id, $category, $name, $price)
    {
        global $pdo;
        // Prepare and execute the update query
        $sql = "UPDATE products SET category = ?, name = ?, price = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        // Execute the update and return the result
        return $stmt->execute(array($category, $name, $price, $id));
    }


}