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
        $query = "SELECT 
                p.*,
                COUNT(DISTINCT l.id) AS likes,
                COUNT(DISTINCT c.id) AS comments,
                COUNT(DISTINCT s.id) AS stars,
                GROUP_CONCAT(DISTINCT l.user_username) AS liked_by,
                GROUP_CONCAT(DISTINCT s.user_username) AS starred_by,
                f.following_username AS following_username,
                u.profile_image AS following_profile_image
            FROM 
                post p
            LEFT JOIN 
                `like` l ON p.id = l.post_id
            LEFT JOIN 
                comment c ON p.id = c.post_id
            LEFT JOIN 
                star s ON p.id = s.post_id
            JOIN 
                follow f ON p.user_username = f.following_username
            LEFT JOIN 
                user u ON f.following_username = u.username
            WHERE 
                f.follower_username = ?
            GROUP BY 
                p.id
            ORDER BY 
                p.posted DESC;";
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

    public function getUserByUsername($username) {
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 0) {
            return null;
        }
    
        return $result->fetch_assoc();
    }

    public function getFollowers($username) {
        $query = "SELECT follower_username FROM Follow WHERE following_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $followers = array();

        while ($row = $result->fetch_assoc()) {
            $follower = $this->getUserByUsername($row['follower_username']);
            if ($follower) {
                $followers[] = $follower;
            }
        }

        return $followers;
    }

    public function getFollowings($username) {
        $query = "SELECT following_username FROM Follow WHERE follower_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $followings = array();

        while ($row = $result->fetch_assoc()) {
            $following = $this->getUserByUsername($row['following_username']);
            if ($following) {
                $followings[] = $following;
            }
        }

        return $followings;
    }

    public function isFollowing($followerUsername, $followingUsername) {
        $query = "SELECT * FROM Follow WHERE follower_username = ? AND following_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $followerUsername, $followingUsername);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return false;
        }

        return true;
    }

    public function follow($followerUsername, $followingUsername) {
        $query = "INSERT INTO Follow (follower_username, following_username) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $followerUsername, $followingUsername);

        return $stmt->execute();
    }

    public function unfollow($followerUsername, $followingUsername) {
        $query = "DELETE FROM Follow WHERE follower_username = ? AND following_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $followerUsername, $followingUsername);

        $stmt->execute();
    }

    public function getFollowersCount($username) {
        $query = "SELECT COUNT(*) as num_followers FROM Follow WHERE following_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['num_followers'];
    }

    public function getFollowingsCount($username) {
        $query = "SELECT COUNT(*) as num_followings FROM Follow WHERE follower_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['num_followings'];
    }

    public function getPostsCount($username) {
        $query = "SELECT COUNT(*) as num_posts FROM Post WHERE user_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['num_posts'];
    }

    /**Method to add a like to a post. */
    public function addLike($post, $user) {
        $query = "INSERT INTO `Like` (`user_username`, `post_id`, `date_liked`) VALUES (?, ?, ?)";
        // Get the current datetime
        $date_posted = date("Y-m-d");
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sis", $user, $post, $date_posted);
        try {
            $stmt->execute();
        }catch(Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        }
        $stmt->close();
        return true;
    }

    /**Method to  unlike a post. */
    public function removeLike($post, $user) {
        $query = "DELETE FROM `Like`
              WHERE `user_username` = ? AND `post_id` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $user, $post);
        try {
            $stmt->execute();
        } catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        }
        $stmt->close();
        return true;
    }

    /**Method to star a post */
    public function addStar($post, $user) {
        $query = "INSERT INTO `Star` (`user_username`, `post_id`, `date_starred`) VALUES (?, ?, ?)";
        // Get the current datetime
        $date_posted = date("Y-m-d");
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sis", $user, $post, $date_posted);
        try {
            $stmt->execute();
        }catch(Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        }
        $stmt->close();
        return true;
    }

    /**Method to remove a starred post. */
    public function removeStar($post, $user) {
        $query = "DELETE FROM `Star`
              WHERE `user_username` = ? AND `post_id` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $user, $post);
        try {
            $stmt->execute();
        } catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        }
        $stmt->close();
        return true;
    }

    /**Method to get all the comments of a specific post. */
    public function getCommentsOfPost($post) {
        $query = "SELECT
            Comment.user_username,
            Comment.post_id,
            Comment.comment_text,
            Comment.date_posted,
            User.profile_image
        FROM
            Comment
        JOIN
            User ON Comment.user_username = User.username
        WHERE
            Comment.post_id = ?
        ORDER BY Comment.date_posted DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $post);
        try { 
            $stmt->execute();
            $result = $stmt->get_result();

            //Check if there is any result.
            if ($result->num_rows > 0) {
                $comments = $result->fetch_all(MYSQLI_ASSOC);   
                return $comments;
            } else {
                return [];
            }
        }catch(Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        } finally {
            $stmt->close();
        }
    }

    /**Method to add a comment. */
    public function addComment($post, $user, $body) {
        $query = "INSERT INTO `Comment` (user_username, post_id, comment_text, date_posted)  VALUES (?,?,?,?)";
        $date_posted = date("Y-m-d H:i:s");
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("siss", $user, $post,$body, $date_posted);

        try {
            $stmt->execute();
        } catch(Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        }
        $stmt->close();
        return true;
    }

    /**Method to retrive the notifications of a follower. */
    public function getNotifications($user) {
        $query = "SELECT 
        Notification.*, 
        User.profile_image AS from_user_profile_pic 
     FROM 
        `Notification` 
     JOIN 
        `User` 
     ON 
        Notification.from_user_username = User.username 
     WHERE 
        to_user_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);

        try {
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch(Exception $e) {
            echo "Error:", $e->getMessage(),"\n";
        }
    }
}

?>