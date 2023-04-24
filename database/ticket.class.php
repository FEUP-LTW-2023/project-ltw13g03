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
        public string $agent;

        public function __construct(int $ticketId, string $title, string $body, string $hashtag, int $priority,
                                        string $status, string $date, string $client, string $agent) {

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
    }
?>