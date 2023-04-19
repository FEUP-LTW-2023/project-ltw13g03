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