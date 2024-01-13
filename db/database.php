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
        // Controlla se esiste già un utente con lo stesso username
        $existingUserQuery = "SELECT * FROM user WHERE username = ?";
        $existingUserStmt = $this->db->prepare($existingUserQuery);
        $existingUserStmt->bind_param('s', $username);
        $existingUserStmt->execute();
        $existingUserResult = $existingUserStmt->get_result();
    
        if ($existingUserResult->num_rows > 0) {
            // L'utente con questo username esiste già, registrazione fallita
            return false;
        }
    
        // Hash della password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Preparazione della query
        $insertUserQuery = "INSERT INTO user (name, surname, username, password, date_of_birth, gender) VALUES (?, ?, ?, ?, ?, ?)";
        $insertUserStmt = $this->db->prepare($insertUserQuery);
    
        // Bind dei parametri
        $insertUserStmt->bind_param('ssssss', $name, $surname, $username, $hashedPassword, $dateOfBirth, $gender);
    
        // Esecuzione della query
        if ($insertUserStmt->execute()) {
            // Registrazione completata con successo, restituisci i dati dell'utente
            $userId = $insertUserStmt->insert_id;
            $userData = array(
                "name" => $name,
                "surname" => $surname,
                "username" => $username,
                "date_of_birth" => $dateOfBirth,
                "gender" => $gender
            );
    
            return $userData;
        } else {
            // Registrazione fallita
            return false;
        }
    }
}

?>