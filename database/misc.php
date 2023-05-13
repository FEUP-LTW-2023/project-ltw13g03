<?php

    require_once(__DIR__ . '/../database/connection.db.php');

    function getHashtags() {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT name FROM Hashtag');
        $stmt->execute();
    
        return $stmt->fetchAll();
    }

    function getFAQs() {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT faqId, question, answer FROM FAQ');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function getFaqId($question) {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT faqId FROM FAQ WHERE question=?');
        $stmt->execute(array($question));

        return $stmt->fetch()['faqId'];
    }

    function getFaqQuestion($faqId) {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT question FROM FAQ WHERE faqId=?');
        $stmt->execute(array($faqId));

        return $stmt->fetch()['question'];
    }
?>