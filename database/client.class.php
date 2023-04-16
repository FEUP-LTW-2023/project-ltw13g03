<?php
    declare(strict_types = 1);

    class Client {
        public string $username;
        public string $name;
        public string $email;
        public bool $isAgent;
        public bool $isAdmin;

        public function __construct(string $username, string $name, string $email, bool $isAgent, bool $isAdmin) {
            $this->username = $username;
            $this->name = $name;
            $this->email = $email;
            $this->isAgent = $isAgent;
            $this->isAdmin = $isAdmin;
        }
        
        static function getAllUsers(PDO $db) : array {
            //$stmt = $db->prepare('SELECT username, name, email FROM Client');
            $stmt = $db->prepare('SELECT c.username, c.name, c.email, COALESCE(a.isAgent, false) as isAgent, COALESCE(ad.isAdmin, false) as isAdmin FROM Client c LEFT JOIN Agent a ON c.username = a.username LEFT JOIN Admin ad ON a.username = ad.username');
            $stmt->execute();
            $users = array();
            while ($user = $stmt->fetch()) {
                echo $user['username'] . $user['isAgent'];
                $users[] = new Client(
                    $user['username'],
                    $user['name'],
                    $user['email'],
                    (bool) $user['isAgent'],
                    (bool) $user['isAdmin']
                );
            }

            return $users;
        }  
    }
?>