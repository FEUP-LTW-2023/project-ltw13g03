<?php
    require_once(__DIR__ . '/../database/misc.php');
    class Client {
        public string $username;
        public string $name;
        public string $email;
        public bool $isAgent;
        public bool $isAdmin;
        public array $departments;

        public function __construct(string $username, string $name, string $email, bool $isAgent, bool $isAdmin, array $departments) {
            $this->username = $username;
            $this->name = $name;
            $this->email = $email;
            $this->isAgent = $isAgent;
            $this->isAdmin = $isAdmin;
            $this->departments = $departments;
        }

        static function getAgentDepartments(PDO $db, string $username) {
            $stmt2 = $db->prepare('SELECT username, name FROM AgentDepartment LEFT JOIN Department USING(departmentID) WHERE username = ?');
            $stmt2->execute(array($username));
            $dep = $stmt2->fetchAll();
            return $dep;
        }

        static function getAllUsers(PDO $db) : array {
            $stmt = $db->prepare('SELECT c.username, c.name, c.email, COALESCE(a.isAgent, false) as isAgent, COALESCE(ad.isAdmin, false) as isAdmin FROM Client c LEFT JOIN Agent a ON c.username = a.username LEFT JOIN Admin ad ON a.username = ad.username');
            $stmt->execute();
            $users = array();
            while ($user = $stmt->fetch()) {
                $dep = Client::getAgentDepartments($db, $user['username']);

                $users[] = new Client(
                    $user['username'],
                    $user['name'],
                    $user['email'],
                    (bool) $user['isAgent'],
                    (bool) $user['isAdmin'],
                    $dep
                );
            }

            return $users;
        }

        static function getUser(PDO $db, string $username) {
            $stmt = $db->prepare('SELECT c.username, c.name, c.email, COALESCE(a.isAgent, false) as isAgent, COALESCE(ad.isAdmin, false) as isAdmin FROM Client c LEFT JOIN Agent a ON c.username = a.username LEFT JOIN Admin ad ON a.username = ad.username WHERE c.username = ?');
            $stmt->execute(array($username));
            $user = $stmt->fetch();
            $dep = Client::getAgentDepartments($db, $username);
            $client = new Client(
                $user['username'],
                $user['name'],
                $user['email'],
                (bool) $user['isAgent'],
                (bool) $user['isAdmin'],
                $dep
            );
            return $client;
        }

        static function updateUserRole(PDO $db, string $username, bool $isAgent, bool $isAdmin) {
            $stmt = $db->prepare('
                UPDATE Admin SET isAdmin = ?
                WHERE username = ?
            ');

            $stmt->execute(array($isAdmin ? 1 : 0, $username));
            
            
            $stmt = $db->prepare('
                UPDATE Agent SET isAgent = ?
                WHERE username = ?
            ');
            $stmt->execute(array(($isAdmin || (!$isAdmin && $isAgent)) ? 1 : 0, $username));
            
        }

        static function updateUserDepartments(PDO $db, string $username, string $department, bool $add) {
            $stmt = $db->prepare('SELECT departmentId FROM Department WHERE name = ?');
            $stmt->execute(array($department));
            $departmentId = $stmt->fetch();

            if ($departmentId !== false) {
                $departmentId = $departmentId['departmentId'];
            } else return;
            if ($add) {
                $stmt = $db->prepare('SELECT isAgent FROM Agent WHERE username = ?');
                $stmt->execute(array($username));
                $isAgent = (bool) $stmt->fetch();
                
                if (!($isAgent && !$isAgent['isAgent'])) {
                    return;
                } 

                $stmt = $db->prepare('INSERT INTO AgentDepartment (username, departmentID) VALUES (?, ?)');
                $stmt->execute(array($username, $departmentId));
            } else {
                $stmt = $db->prepare('DELETE FROM AgentDepartment WHERE username=? AND departmentID=?');
                $stmt->execute(array($username, $departmentId));
            }
        }
    }
?>