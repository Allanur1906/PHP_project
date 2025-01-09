<?php

class User {
    public static function getAllUsers() {
        global $pdo;
        $sql = "SELECT * 
                FROM users";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUser($id) {
        global $pdo;

        $sql = "SELECT * FROM users 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":id" => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findUser($email) {
        global $pdo;

        $sql = "SELECT * 
                FROM users 
                WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":email" => $email));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($first_name, $last_name, $email, $password, $role_id)
    {
        global $pdo;

        $sql = "INSERT INTO users (first_name, last_name, email, password, role_id) 
            VALUES (:first_name, :last_name, :email, :password,:role_id)";

        $stmt = $pdo->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR); // Use PDO::PARAM_STR for float values
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_STR);

        // Execute the query
        if ($stmt->execute()) {
            return $pdo->lastInsertId(); // Return the ID of the newly created product
        } else {
            return false; // Return false if the query failed
        }

    }

    public static function delete($id) {
        global $pdo;
        // Query to delete the product from the database
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(array(":id" => $id)); // Returns true if successful, false otherwise
    }

    public static function update($id, $first_name, $last_name ,$role_id)
    {
        global $pdo;
        // Prepare and execute the update query
        $sql = "UPDATE users SET first_name = ?, last_name = ?, role_id=?  WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        // Execute the update and return the result
        return $stmt->execute(array($first_name, $last_name, $role_id, $id,));
    }



}
?>