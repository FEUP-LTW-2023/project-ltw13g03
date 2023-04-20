<?php 
    require_once(__DIR__ . '/../database/tickets.php');

    function output_ticket_preview($ticket_id) {
        $ticket = getTicket($ticket_id); ?>
        <a class="ticketpreview" href="../pages/ticket.php?id=<?=$ticket['ticketId']?>">
            <h3><?=$ticket['title']?></h3>
            <p><?php 
            if (strlen($ticket['body']) > 200)
                $body = substr($ticket['body'], 0, 200) . '...';
            else $body = $ticket['body'];
            echo $body;?></p>
            <div id="status">Status: <?=$ticket['status']?></div>
            <time datetime="<?=$ticket['date']?>">Date: <?=$ticket['date']?></time>
        </a>
    <?php }

    function output_main_content(){ ?>
        <section id="tickets">
            <input id="searchticket" type="text" placeholder="SEARCH">
            <?php 
            $tickets = getTickets();
            foreach ($tickets as $ticket) {
                output_ticket_preview($ticket['ticketId']);
            } ?>
        </section>
    <?php }

    function new_ticket_form(){ ?>
        <section class="create_ticket">
            <h2>Create a New Ticket</h2>
            <form>
                <label id="department">
                    Department
                    <select>
                        <option value="hr">Human Resources</option>
                        <option value="it">Information Technology</option>
                        <option value="sales">Sales</option>
                        <option value="finance">Finance</option>
                        <option value="other">Other</option>
                    </select>
                </label>
                <label id="ticket_description">
                    Description
                    <textarea name="ticket_description" id="" cols="30" rows="10" placeholder="Write a description of your ticket here..."></textarea>
                </label>
                <button>Submit</button>
            </form>
        </section>
    <?php }
?>