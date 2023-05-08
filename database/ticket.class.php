<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../database/client.class.php');

    require_once(__DIR__ . '/../database/department.php');

    class Ticket {
        public int $ticketId;
        public string $title;
        public string $body;
        public ?string $department;
        public array $hashtags;
        public int $priority;
        public string $status;
        public DateTime $date;
        public int $client;
        public ?int $agent;


        public function __construct(int $ticketId, string $title, string $body, ?int $department, string $hashtags, int $priority,
                                        string $status, string $date, int $client, ?int $agent) {

            $this->ticketId = $ticketId;
            $this->title = $title;
            $this->body = $body;
            $this->department = getDepartment($department);
            $this->hashtags = json_decode($hashtags, true);
            $this->priority = $priority;
            $this->status = $status;
            $this->date = new DateTime($date);
            $this->client = $client;
            $this->agent = $agent;
        }

        static function getAllTickets(PDO $db) {
            $stmt = $db->prepare('SELECT ticketId FROM Ticket');
            $stmt->execute();

            return $stmt->fetchAll();
        }

        static function getTicket(PDO $db, int $ticketId) {
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE ticketId=?');
            $stmt->execute(array($ticketId));
        
            $ticket = $stmt->fetch();

            if ($ticket){
                return new Ticket(
                    $ticket['ticketId'],
                    $ticket['title'],
                    $ticket['body'],
                    $ticket['department'],
                    $ticket['hashtags'],
                    $ticket['priority'],
                    $ticket['status'],
                    $ticket['date'],
                    $ticket['client'],
                    $ticket['agent']
                );
            }
        }

        static function getTicketsFiltered(PDO $db, string $search, string $status, string $priority) {
            if (empty($status) && strlen($priority) === 0){
                $stmt = $db->prepare('SELECT * FROM Ticket WHERE title LIKE ?');
                $stmt->execute(array('%' . $search . '%'));
            }
            else if (strlen($priority) === 0){
                $stmt = $db->prepare('SELECT * FROM Ticket WHERE title LIKE ? AND status=?');
                $stmt->execute(array('%' . $search . '%', $status));
            } else if (empty($status)){
                $stmt = $db->prepare('SELECT * FROM Ticket WHERE title LIKE ? AND priority=?');
                $stmt->execute(array('%' . $search . '%', intval($priority, 10)));
            } else {
                $stmt = $db->prepare('SELECT * FROM Ticket WHERE title LIKE ? AND status=? AND priority=?');
                $stmt->execute(array('%' . $search . '%', $status, intval($priority, 10)));
            }

            $tickets = array();

            while ($ticket = $stmt->fetch()) {
                $tickets[] = new Ticket(
                    $ticket['ticketId'],
                    $ticket['title'],
                    $ticket['body'],
                    $ticket['department'],
                    $ticket['hashtags'],
                    $ticket['priority'],
                    $ticket['status'],
                    $ticket['date'],
                    $ticket['client'],
                    $ticket['agent']
                );
            }

            return $tickets;
        }

        static function getComments(PDO $db, int $ticketId) {
            $stmt = $db->prepare('SELECT * FROM Comment WHERE ticketId=?');
            $stmt->execute(array($ticketId));
        
            return $stmt->fetchAll();
        }

        static function addComment(PDO $db, int $ticketId, string $username, string $text) {
            $date = date('Y-m-d');
            $userId = Client::getUserId($db, $username);
            $stmt = $db->prepare('INSERT INTO Comment (ticketID, userId, date, text) VALUES (?, ?, ?, ?)');
            $stmt->execute(array($ticketId, $userId, $date, $text));
        }

        static function createTicket(PDO $db, $title, $body, $department, $hashtags, $priority, $client) {
            $stmt = $db->prepare('INSERT INTO Ticket (title, body, department, hashtags, priority, status, date, client) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

            $stmt->execute(array(
                $title,
                $body,
                getDepartmentId($department),
                $hashtags,
                $priority,
                'Open',
                date('Y-m-d'),
                $client
            ));
        }

        static function removeHashtag(PDO $db, int $ticketId, string $hashtag, int $userId) {
            $stmt = $db->prepare('SELECT hashtags FROM Ticket WHERE ticketId=?');
            $stmt->execute(array($ticketId));
            
            $hashtags = json_decode($stmt->fetch()['hashtags'], true);

            array_splice($hashtags, array_search($hashtag, $hashtags), 1);

            $hashtags = json_encode($hashtags);

            $stmt = $db->prepare('INSERT INTO Modification (field, old, new, date, ticketID, userId) VALUES 
                ("Hashtag", ?, "", ?, ?, ?)');
            $stmt->execute(array($hashtag, date('Y-m-d'), $ticketId, $userId));

            $stmt = $db->prepare('UPDATE Ticket SET hashtags=? WHERE ticketId=?');
            $stmt->execute(array($hashtags, $ticketId));

            return $hashtags;
        }

        static function addHashtag(PDO $db, int $ticketId, string $hashtag, int $userId) {
            $stmt = $db->prepare('SELECT name FROM Hashtag');
            $stmt->execute();
            $global_hashtags = $stmt->fetchAll();

            $stmt = $db->prepare('SELECT hashtags FROM Ticket WHERE ticketId=?');
            $stmt->execute(array($ticketId));
            
            $hashtags = $stmt->fetch()['hashtags'];

            $found = false;
            foreach ($global_hashtags as $global_hashtag){
                if ($global_hashtag['name'] === $hashtag)
                    $found = true;
            }
            if (!$found)
                return $hashtags;

            $hashtags = json_decode($hashtags, true);

            array_push($hashtags, $hashtag);

            $hashtags = json_encode($hashtags);

            $stmt = $db->prepare('INSERT INTO Modification (field, old, new, date, ticketID, userId) VALUES 
                ("Hashtag", "", ?, ?, ?, ?)');
            $stmt->execute(array($hashtag, date('Y-m-d'), $ticketId, $userId));

            $stmt = $db->prepare('UPDATE Ticket SET hashtags=? WHERE ticketId=?');
            $stmt->execute(array($hashtags, $ticketId));

            return $hashtags;
        }

        static function changeDepartment(PDO $db, int $ticketId, string $department, int $userId) {
            $departmentId = getDepartmentId($department);

            $stmt = $db->prepare('INSERT INTO Modification (field, old, new, date, ticketID, userId)
                        SELECT ?, ifnull(department, ""), ?, ?, ?, ? FROM Ticket WHERE ticketId=?');
            $stmt->execute(array("Department", $departmentId, date('Y-m-d'), $ticketId, $userId, $ticketId));

            $stmt = $db->prepare('UPDATE Ticket SET department=?, agent=NULL WHERE ticketId=?');
            $stmt->execute(array($departmentId, $ticketId));

            Ticket::changeStatus($db, $ticketId, 'Open', $userId);
        }

        static function changeAgent(PDO $db, int $ticketId, string $agent, int $userId) {
            $stmt = $db->prepare('INSERT INTO Modification (field, old, new, date, ticketID, userId) 
                        SELECT ?, ifnull(agent, ""), ?, ?, ?, ? FROM Ticket WHERE ticketId = ?');
            $stmt->execute(array("Agent", Client::getUserId($db, $agent), date('Y-m-d'), $ticketId, $userId, $ticketId));

            $stmt = $db->prepare('UPDATE Ticket SET agent=(SELECT userId FROM Client WHERE username=?) WHERE ticketId=?');
            $stmt->execute(array($agent, $ticketId));
        }

        static function getAgent(PDO $db, int $ticketId) {
            $stmt = $db->prepare('SELECT username FROM Client WHERE userId = (SELECT agent FROM Ticket WHERE ticketId=?)');
            $stmt->execute(array($ticketId));

            return $stmt->fetch();
        }

        static function changeStatus(PDO $db, int $ticketId, string $status, int $userId) {
            if ($status === 'Closed') {
                $stmt = $db->prepare('INSERT INTO Modification (field, old, new, date, ticketID, userId) VALUES
                            ("Status", "", "Closed", ?, ?, ?)');
                $stmt->execute(array(date('Y-m-d'), $ticketId, $userId));
            }

            $stmt = $db->prepare('UPDATE Ticket SET status=? WHERE ticketId=?');
            $stmt->execute(array($status, $ticketId));
        }

        static function getModifications(PDO $db, int $ticketId) {
            $stmt = $db->prepare('SELECT * FROM Modification WHERE ticketId=?');
            $stmt->execute(array($ticketId));

            return $stmt->fetchAll();
        }
    }
?>