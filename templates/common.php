<?php
    function output_header(){ ?>
        <!DOCTYPE html>
        <html lang="en-US">
        <head>
            <title>Tickets</title>    
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="../style/style.css" rel="stylesheet">
            <link href="../style/forms.css" rel="stylesheet">
        </head>
        <body>
            <header>
                <h1><a href="index.php">TICKETS</a></h1>
                <a href="faq.php"><h2>FAQ</h2></a>
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