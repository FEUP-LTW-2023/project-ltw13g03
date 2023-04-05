<?php
    session_start();

    require_once(__DIR__ . '/../templates/common.php');

    output_header();
?>
<main>
    
        <a href="profile.php">profile</a>
        <a href="login.php">login</a>
        <a href="register.php">register</a>
</main>

<?php
    output_footer();
?>