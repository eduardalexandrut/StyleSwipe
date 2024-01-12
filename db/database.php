<?php

class DatabaseHelper {
    private $db;
    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    public function checkLogin($username, $password){
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // L'utente non esiste
            return null;
        }

        $userData = $result->fetch_assoc();
        $hashedPassword = $userData['password'];

        if (password_verify($password, $hashedPassword)) {
            return $userData; // Login riuscito
        } else {
            return null; // Password non corretta
        }
    }   

    public function registerUser($name, $surname, $username, $password, $dateOfBirth, $gender){
        // Hash della password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Preparazione della query
        $query = "INSERT INTO user (name, surname, username, password, date_of_birth, gender) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
    
        // Bind dei parametri
        $stmt->bind_param('ssssss', $name, $surname, $username, $hashedPassword, $dateOfBirth, $gender);
    
        // Esecuzione della query
        return $stmt->execute();
    }
}

?>