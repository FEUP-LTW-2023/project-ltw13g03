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
            <link href="../style/ticket.css" rel="stylesheet">
        </head>
        <body>
            <header>
                <h1><a href="index.php">TICKETS</a></h1>
                <a href="faq.php"><h2>FAQ</h2></a>
                <?php if ($logged_in) { ?>
                    <a id="logout" href="../actions/action_logout.php"><img src="https://freesvg.org/img/artmaster_logout_mini_icon.png" alt="logout button"></a>
                    <a id="profpic" href="profile.php"><img src="https://picsum.photos/80/80" alt=""></a>
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