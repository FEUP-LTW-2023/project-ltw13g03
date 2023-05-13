<?php

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/client.class.php');
require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/misc.php');

function output_comments($id, $status){ 
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
                <?php if ($comment['faqId'] != null) { ?>
                    <a href="faq.php#<?=$comment['faqId']?>""> FAQ - <?=getFaqQuestion($comment['faqId'])?></a>
                <?php } ?>
            </article>
        <?php }  if ($status != 'Closed') { ?>
    <div> </div>
    <form method="post" action="../actions/action_comment.php">
        <h3>Leave a comment</h3>
        <input type="hidden" name="ticketId" value="<?=$id?>"/>
        <textarea name="text" placeholder="Your thoughts here..."></textarea>
        <?php
        $user = getUserInfo($_SESSION['username']);
        if ($user['isAgent']) { ?>
        <label id="faq">
            <select name="faq" autocomplete="off">
                <option value="none" selected> Refer to a FAQ (optional) </option>
                <?php
                $faqs = getFAQs();
                foreach ($faqs as $faq) { ?>
                    <option><?=$faq['question']?></option>
                <?php } ?>
            </select>
        </label>
        <?php } ?>
        <button type="submit">Reply</button>
    </form>
        <?php } ?>
    </section>

<?php } ?>