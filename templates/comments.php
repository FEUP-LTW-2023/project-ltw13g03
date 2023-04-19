<?php

require_once(__DIR__ . '/../database/tickets.php');

function output_comments($id){ 
    $comments = getComments($id); ?>
    <section id="comments">
        <?php foreach ($comments as $comment) { ?>
            <article class="comment">
                <img src="https://picsum.photos/80/80" alt="comment profile picture">
                <span class="comment_username"><?=$comment['username']?></span>
                <time datetime="<?=$comment['date']?>"><?=$comment['date']?></time>
                <p>
                    <?=$comment['text']?>
                </p>
            </article>
        <?php } ?>
    <form>
        <textarea placeholder="Leave a comment"></textarea>
        <button type="submit">Reply</button>
    </form>
    </section>

<?php } ?>

?>