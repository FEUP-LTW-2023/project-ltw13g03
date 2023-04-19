<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    }

    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/comments.php');
    require_once(__DIR__ . '/../database/tickets.php');

    output_header(true);

    $ticket = getTicket($_GET['id']);
?>

<section id="ticket">
    <h2><?=$ticket['title']?></h2>
    <aside>
        <div id="author">
            <?=$ticket['client']?>
        </div>
        <time datetime="<?=$ticket['date']?>">Date: <?=$ticket['date']?></time>
        <div id="department">
            Department:
        </div>
        <div id="agent">

        </div>
        <div id="status">Status: <?=$ticket['status']?></div>
        <div id="tags">
            <span class="tag">Lorem</span>
            <span class="tag">Ipsum</span>
        </div>
    </aside>
    <article id="ticket_description">
        <p>
            <?=$ticket['body']?>
        </p>
    </article>
    <?php output_comments($ticket['ticketId']); ?>
</section>


<?php
    output_footer();
?>