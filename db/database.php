<?php

class DatabaseHelper {
    private $db;
    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    public function checkLogin($email, $password){
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
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

    public function registerUser($name, $surname, $username, $password, $dateOfBirth, $gender, $email, $profilepic){
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
     $insertUserQuery = "INSERT INTO user (name, surname, username, password, date_of_birth, gender, profile_image, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
     $insertUserStmt = $this->db->prepare($insertUserQuery);
 
     // Bind dei parametri
     $insertUserStmt->bind_param('ssssssss', $name, $surname, $username, $hashedPassword, $dateOfBirth, $gender, $profilepic, $email);
 
     // Esecuzione della query
     if ($insertUserStmt->execute()) {
         // Registrazione completata con successo, restituisci i dati dell'utente
         $userData = array(
             "name" => $name,
             "surname" => $surname,
             "username" => $username,
             "date_of_birth" => $dateOfBirth,
             "gender" => $gender,
             "profilepic" => $profilepic,
             "email" => $email
         );
 
         return $userData;
     } else {
         // Registrazione fallita
         return false;
     }
 }

    //Method to get all the posts of all the users $user is following,along with the num of likes, num of comments and num of stars.
    public function getPostsOfFollowing($user) {
        $query = "SELECT p.*,
        COUNT(DISTINCT l.id) AS likes,
        COUNT(DISTINCT c.id) AS comments,
        COUNT(DISTINCT s.id) AS stars
        FROM post p
        LEFT JOIN `like` l ON p.id = l.post_id
        LEFT JOIN comment c ON p.id = c.post_id
        LEFT JOIN star s ON p.id = s.post_id
        JOIN follow f ON p.user_username = f.following_username
        WHERE f.follower_username = ?
        GROUP BY p.id
        ORDER BY p.posted DESC;";
        //$query = "SELECT * FROM post WHERE user_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        try {
            $stmt->execute();
            $result = $stmt->get_result();

            //Check if there is any result.
            if ($result->num_rows > 0) {
                $posts = $result->fetch_all(MYSQLI_ASSOC);
                return $posts;
            }else {
                return [];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        } finally {
            $stmt->close();
        }
    }

   // Method to add a new post.
public function createPost($user, $comment, $image) {
    $query = "INSERT INTO Post (user_username, comment, image, posted) VALUES (?, ?, ?, ?)";
    $stmt = $this->db->prepare($query);

    // Get the current datetime
    $posted = date("Y-m-d H:i:s");
    
    // Bind parameters in the correct order
    $stmt->bind_param('ssss', $user, $comment, $image, $posted);
    
    try {
        $stmt->execute();
        
        // Return the auto-generated ID of the new post
        $postId = $stmt->insert_id;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        return false;
    }
    
    $stmt->close();
    return $postId;
}

    //Method to add an item.
    public function createItem($post, $name, $brand, $link, $price, $size, $x, $y) {
        $query = "INSERT INTO Item (post_id, name, brand, link, price, size, x, y) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isssdsdd", $post, $name, $brand, $link, $price, $size, $x, $y);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        }
        $stmt->close();
    }

    public function searchUser($query) {
        $stmt = $this->db->prepare("SELECT * FROM User WHERE username LIKE ?");
        $param = "%".$query."%";
        $stmt->bind_param("s", $param);
        $stmt->execute();
        return $stmt->get_result();
    }

}

?>