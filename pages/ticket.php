<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    }

    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/comments.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/misc.php');

    output_header(true);

    $db = getDatabaseConnection();
    $ticket = Ticket::getTicket($db, $_GET['id']);
?>

<section id="ticket">
    <h2><?=$ticket->title?></h2>
    <aside>
        <div id="author">
            <?=$ticket->client?>
        </div>
        <time datetime="<?=$ticket->date->format('Y-m-d')?>">Date: <?=$ticket->date->format('Y-m-d')?></time>
        <div id="department">
            Department:
        </div>
        <div id="agent">

        </div>
        <div id="status">Status: <?=$ticket->status?></div>
        <div id="tags">
            <ul>
                <?php foreach ($ticket->hashtags as $hashtag) { ?>
                    <li class="tag"><?=$hashtag?></li>
                <?php } ?>
            </ul>

            <select>
                <option value="unspecified" selected>+</option>
                <?php 
                    $tags = getHashtags();
                    foreach ($tags as $tag) { ?>
                        <option><?=$tag['name']?></option>
                <?php } ?>
            </select>
        </div>
    </aside>
    <article id="ticket_description">
        <p>
            <?=$ticket->body?>
        </p>
    </article>
    <?php output_comments($ticket->ticketId); ?>
</section>


<?php
    output_footer();
?>