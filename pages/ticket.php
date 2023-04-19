<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    }

    require_once(__DIR__ . '/../templates/common.php');
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
        <time datetime="">Date:</time>
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
    <section id="comments">
        <article class="comment">
            <img src="https://picsum.photos/80/80" alt="comment profile picture">
            <span class="comment_username">Username</span>
            <time datetime="">date</time>
            <p>
                This is a comment
            </p>
        </article>
        <article class="comment">
            <img src="https://picsum.photos/80/80" alt="comment profile picture">
            <span class="comment_username">Username</span>
            <time datetime="">date</time>
            <p>
               This is a comment
            </p>
        </article>
        <form>
            <textarea placeholder="Leave a comment"></textarea>
            <button type="submit">Reply</button>
        </form>
    </section>
</section>


<?php
    output_footer();
?>