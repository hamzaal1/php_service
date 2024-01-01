<?php

namespace App;

use App\Database\Connection;
use PDO;

class Auth
{
    protected static $connection;

    protected static function initConnection()
    {
        if (self::$connection === null) {
            // Use the Singleton pattern to get the connection instance
            $connection = Connection::getInstance();
            self::$connection = $connection->getConnection();
        }
    }

    public static function credentiel($username, $password)
    {
        self::initConnection();

        // Use prepared statement to prevent SQL injection
        $query = "SELECT * FROM users WHERE name = :username AND password = :password";
        $stmt = self::$connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If a user is found, create a session
        if ($user) {
            self::createSession($user['id']);
            return true;
        }

        return false; // Return 0 indicating login failure
    }

    protected static function createSession($userID)
    {
        // Start the session if not started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Store user ID in the session
        $_SESSION['user'] = $userID;
    }

    public static function logout()
    {
        // Start the session if not started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Unset user information
        if (self::check()) {
            unset($_SESSION['user']);
            session_destroy();
            return 1;
        }

        return 0;
    }


    public static function check()
    {
        // Start the session if not started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the 'user' key exists in the session
        return isset($_SESSION['user']);
    }
    public static function user()
    {
        // Start the session if not started
        if (self::check()) {
            return $_SESSION['user'];
        }
        // Check if the 'user' key exists in the session
        return 0;
    }
}
