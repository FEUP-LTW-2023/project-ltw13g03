<?php
    declare(strict_types = 1);

    class Ticket {
        public int $ticketId;
        public string $title;
        public string $body;
        public array $hashtags;
        public int $priority;
        public string $status;
        public DateTime $date;
        public string $client;
        public ?string $agent;

        public function __construct(int $ticketId, string $title, string $body, string $hashtag, int $priority,
                                        string $status, string $date, string $client, ?string $agent) {

            $this->ticketId = $ticketId;
            $this->title = $title;
            $this->body = $body;
            $this->hashtags = json_decode($hashtag, true);
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
                    $ticket['hashtags'],
                    $ticket['priority'],
                    $ticket['status'],
                    $ticket['date'],
                    $ticket['client'],
                    $ticket['agent']
                );
            }
        }

        static function getTicketsFiltered(PDO $db, string $search) {
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE title LIKE ?');
            $stmt->execute(array($search . '%'));

            $tickets = array();

            while ($ticket = $stmt->fetch()) {
                $tickets[] = new Ticket(
                    $ticket['ticketId'],
                    $ticket['title'],
                    $ticket['body'],
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
        
            $stmt = $db->prepare('INSERT INTO Comment (ticketID, username, date, text) VALUES (?, ?, ?, ?)');
            $stmt->execute(array($ticketId, $username, $date, $text));
        }

        static function createTicket(PDO $db, $title, $body, $hashtags, $priority, $client) {
            $stmt = $db->prepare('INSERT INTO Ticket (title, body, hashtags, priority, status, date, client) VALUES (?, ?, ?, ?, ?, ?, ?)');

            $stmt->execute(array(
                $title,
                $body,
                $hashtags,
                $priority,
                'Open',
                date('Y-m-d'),
                $client
            ));
        }

        static function removeHashtag(PDO $db, int $ticketId, string $hashtag) {
            $stmt = $db->prepare('SELECT hashtags FROM Ticket WHERE ticketId=?');
            $stmt->execute(array($ticketId));
            
            $hashtags = json_decode($stmt->fetch()['hashtags'], true);

            array_splice($hashtags, array_search($hashtag, $hashtags), 1);

            $hashtags = json_encode($hashtags);

            $stmt = $db->prepare('UPDATE Ticket SET hashtags=? WHERE ticketId=?');
            $stmt->execute(array($hashtags, $ticketId));

            return $hashtags;
        }

        static function addHashtag(PDO $db, int $ticketId, string $hashtag) {
            $stmt = $db->prepare('SELECT hashtags FROM Ticket WHERE ticketId=?');
            $stmt->execute(array($ticketId));
            
            $hashtags = json_decode($stmt->fetch()['hashtags'], true);

            array_push($hashtags, $hashtag);

            $hashtags = json_encode($hashtags);

            $stmt = $db->prepare('UPDATE Ticket SET hashtags=? WHERE ticketId=?');
            $stmt->execute(array($hashtags, $ticketId));

            return $hashtags;
        }
    }
?>