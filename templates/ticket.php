<?php 
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/misc.php');

    function output_ticket_preview(int $ticket_id) {
        $db = getDatabaseConnection();
        $ticket = Ticket::getTicket($db, $ticket_id); ?>
        <a class="ticketpreview" href="../pages/ticket.php?id=<?=$ticket->ticketId?>">
            <h3><?=$ticket->title?></h3>
            <p><?php 
            if (strlen($ticket->body) > 200)
                $body = substr($ticket->body, 0, 200) . '...';
            else $body = $ticket->body;
            echo $body;?></p>
            <div id="tags">
                <ul>
                    <?php $tags = $ticket->hashtags;
                        foreach ($tags as $tag) { ?>
                            <li class="tag"><?=$tag?></li>
                    <?php } ?>
                </ul>
            </div>
            <div id="status">Status: <?=$ticket->status?></div>
            <time datetime="<?=$ticket->date->format('Y-m-d')?>">Date: <?=$ticket->date->format('Y-m-d')?></time>
        </a>
    <?php }

    function output_main_content(){ 
        $db = getDatabaseConnection();
        ?>
        <section id="tickets">
            <input id="searchticket" type="text" placeholder="SEARCH">
            <a href="new_ticket.php"><img src="https://cdn-icons-png.flaticon.com/512/61/61050.png" alt="create a new ticket"></a>
            <div id="tags">
                <ul></ul>

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
            <div id="date_filter">
                <label> Start: 
                    <input type="date" min="1970-01-01" id="start_date">
                </label>
                <label> End: 
                    <input type="date" min="1970-01-01" id="end_date">
                </label>
            </div>
            <?php 
            $tickets = Ticket::getAllTickets($db);
            foreach ($tickets as $ticket) {
                output_ticket_preview($ticket['ticketId']);
            } ?>
        </section>
    <?php }

    function new_ticket_form(){ ?>
        <section class="create_ticket">
            <h2>Create a New Ticket</h2>
            <form method="post" action="../actions/action_create_ticket.php">
                <label id="department">
                    Department (optional)
                    <select name="department" autocomplete="off">
                        <option value="unspecified" selected> - </option>
                        <?php 
                        $departments = getDepartments();
                        foreach ($departments as $department) { ?>
                            <option><?=$department['name']?></option>
                        <?php } ?>
                    </select>
                </label>
                <label id="ticket_title">
                    Title
                    <input type="text" name="ticket_title" autocomplete="off">
                </label>
                <label id="ticket_priority">
                    Priority
                    <input id="low_priority" name="ticket_priority" type="range" value="0" min="0" max="2" step="1" list="ticket_priority_list" autocomplete="off">
                    <datalist id="ticket_priority_list">
                        <option value="0" label="Low"></option>
                        <option value="1" label="Medium"></option>
                        <option value="2" label="High"></option>
                    </datalist>
                </label>
                <div id="tags">
                    <ul></ul>

                    <input list="hashtags" placeholder="Add more tags">
                    <input type="hidden" value="[]" name="tags">
                    <datalist id="hashtags">
                        <?php 
                            $tags = getHashtags();
                            foreach ($tags as $tag) { ?>
                                <option><?=$tag['name']?></option>
                        <?php } ?>
                    </datalist>
                    <img src="https://cdn-icons-png.flaticon.com/512/61/61050.png" alt="add a new tag">
                </div>
                <label id="ticket_description">
                    Description
                    <textarea name="ticket_description" id="" cols="30" rows="10" placeholder="Write a description of your ticket here..." autocomplete="off"></textarea>
                </label>
                <button>Submit</button>
            </form>
        </section>
    <?php }
?>