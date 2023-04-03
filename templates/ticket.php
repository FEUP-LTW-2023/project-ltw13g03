<?php 
    function output_ticket_preview() { ?>
        <div class="ticketpreview">
            <h3>Ticket X</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere volutpat diam et 
            facilisis. Ut vel vulputate risus. Sed metus enim, viverra bibendum malesuada pellentesque, 
            mollis eu nunc. </p>
            <p>Open</p>
            <p>March 23, 2023</p>
        </div>
    <?php }

    function output_main_content(){ ?>
        <section id="tickets">
            <?php for ($i = 1; $i <= 9; $i++) {
                output_ticket_preview();
            } ?>
        </section>
    <?php }
?>