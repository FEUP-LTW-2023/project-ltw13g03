<?php

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/client.class.php');
require_once(__DIR__ . '/../database/ticket.class.php');

function output_comments($id, $status){ 
    $db = getDatabaseConnection();
    $comments = Ticket::getComments($db, $id); ?>
    <section id="comments">
        <?php foreach ($comments as $comment) { ?>
            <article class="comment">
                <?php 
                $db = getDatabaseConnection();
                $filename = $comment['userId'];
                $results = glob(__DIR__ . "/../images/" . $filename . ".*");
                if ($results){
                    $path = "/../images/" . $filename . "." . pathinfo($results[0], PATHINFO_EXTENSION); ?>
                    <img src=<?=$path?> alt="user_image">
                <?php }
                else{ ?>
                    <img src="/../images/default.jpg" alt="user_image">
                <?php }?>
                <span class="comment_username"><?=Client::getUsername($db, $comment['userId'])?></span>
                <time datetime="<?=$comment['date']?>"><?=$comment['date']?></time>
                <p>
                    <?=$comment['text']?>
                </p>
            </article>
        <?php }  if ($status != 'Closed') {?>
    <form method="post" action="../actions/action_comment.php">
        <input type="hidden" name="ticketId" value="<?=$id?>"/>
        <textarea name="text" placeholder="Leave a comment"></textarea>
        <button type="submit">Reply</button>
    </form>
    <?php } ?>
    </section>

<?php } ?>