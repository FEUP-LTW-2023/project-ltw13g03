<?php
    function output_header(bool $logged_in){ ?>
        <!DOCTYPE html>
        <html lang="en-US">
        <head>
            <title>Tickets</title>    
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="../style/style.css" rel="stylesheet">
            <link href="../style/profile.css" rel="stylesheet">
            <link href="../style/faq.css" rel="stylesheet">
            <link href="../style/forms.css" rel="stylesheet">
            <link href="../style/new-ticket.css" rel="stylesheet">
            <link href="../style/users.css" rel="stylesheet">
            <link href="../style/ticket.css" rel="stylesheet">
            <script src="../javascript/dropdown.js" defer></script>
            <script src="../javascript/update_profile.js" defer></script>
        </head>
        <body>
            <header>
                <h1><a href="index.php">TICKETS</a></h1>
                <?php if ($logged_in) { ?>
                    <a href="new_ticket.php"><h2>New Ticket</h2></a>
                    <a href="manage_users.php"><h2>Users</h2></a>
                    <a href="faq.php"><h2>FAQ</h2></a>
                    <div class="profile-dropdown">
                        <img src="https://picsum.photos/80/80" alt="User profile picture">
                        <div class="profile-dropdown-content">
                            <a href="edit_profile.php">Edit profile</a>
                            <a href="../actions/action_logout.php">Sign out</a>
                        </div>
                    </div>
                <?php } ?>
            </header>
        <?php }

    function output_footer(){ ?>
        <footer>
            <p>&copy; Tickets</p>
        </footer>
        </body>
        </html>
    <?php }
?>