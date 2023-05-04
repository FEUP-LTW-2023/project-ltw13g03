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
    require_once(__DIR__ . '/../database/department.php');

    output_header(true);

    $db = getDatabaseConnection();
    $ticket = Ticket::getTicket($db, $_GET['id']);
?>

<section id="ticket" data-id="<?=$_GET['id']?>">
    <h2><?=$ticket->title?></h2>
    <aside>
        <div id="author">
            <?=$ticket->client?>
        </div>
        <time datetime="<?=$ticket->date->format('Y-m-d')?>"><?=$ticket->date->format('Y-m-d')?></time>
        <div id="department">
            <select>
                <?php $departments = getDepartments();
                if (empty($departments)) ?> <option disabled selected>choose a department</option>
                <?php foreach ($departments as $department) {
                    if ($department['name'] === $ticket->department) { ?>
                        <option selected><?=$department['name']?></option>
                    <?php } else {?> 
                        <option><?=$department['name']?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div id="agent">
            <select>
                <?php 
                $db = getDatabaseConnection();
                $selected_agent = Ticket::getAgent($db, $_GET['id']);
                if (is_null($selected_agent['agent'])) { ?>
                    <option disabled selected>assign an agent</option>
                <?php } else { ?>
                    <option selected><?=$selected_agent['agent']?></option>
                <?php }
                $department_agents = getDepartmentAgents($ticket->department);
                foreach ($department_agents as $agent) { ?>
                    <option><?=$agent['username']?></option>
                <?php } ?>
            </select>
        </div>
        <div id="status"><?=$ticket->status?></div>
        <div id="tags">
            <ul>
                <?php foreach ($ticket->hashtags as $hashtag) { ?>
                    <li class="tag"><?=$hashtag?></li>
                <?php } ?>
            </ul>

            <input list="hashtags" placeholder="Add more tags">
            <datalist id="hashtags">
                <?php 
                    $tags = getHashtags();
                    foreach ($tags as $tag) { ?>
                        <option><?=$tag['name']?></option>
                <?php } ?>
            </datalist>
            <img src="https://cdn-icons-png.flaticon.com/512/61/61050.png" alt="add a new tag">
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