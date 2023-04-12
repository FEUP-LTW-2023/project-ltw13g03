<?php
    function output_header(){ ?>
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
            <script src="../javascript/faq_dropdown.js" defer></script>
        </head>
        <body>
            <header>
                <h1><a href="index.php">TICKETS</a></h1>
                <a href="faq.php"><h2>FAQ</h2></a>
                <a id="profpic" href="profile.php"><img src="https://picsum.photos/80/80" alt=""></a>
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