<?php

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/client.class.php');
require_once(__DIR__ . '/../database/ticket.class.php');

function output_comments($id){ 
    $db = getDatabaseConnection();
    $comments = Ticket::getComments($db, $id); ?>
    <section id="comments">
        <?php foreach ($comments as $comment) { ?>
            <article class="comment">
                <img src="https://picsum.photos/80/80" alt="comment profile picture">
                <span class="comment_username"><?=Client::getUsername($db, $comment['userId'])?></span>
                <time datetime="<?=$comment['date']?>"><?=$comment['date']?></time>
                <p>
                    <?=$comment['text']?>
                </p>
            </article>
        <?php } ?>
    <form method="post" action="../actions/action_comment.php">
        <input type="hidden" name="ticketId" value="<?=$id?>"/>
        <textarea name="text" placeholder="Leave a comment"></textarea>
        <button type="submit">Reply</button>
    </form>
    </section>

<?php } ?>

?>