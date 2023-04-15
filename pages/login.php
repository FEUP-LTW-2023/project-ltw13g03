<?php
    session_start();

    if(isset($_SESSION['username'])){
        header("Location: /");
    }

    require_once(__DIR__ . '/../templates/common.php');

    output_header(false);
?>

<section id="login">
    <h1>Login</h1>
    <form action="../actions/action_login.php" method="post">
    <label>
        Username <input type="text" name="username">
    </label>
    <label>
        Password <input type="password" name="password">
    </label>
    <button type="submit">Login</button>
    </form>
    <span id="not_registered">Don't have an account yet? Click <a href="register.php">here</a> to register!</span>
</section>

<?php
    output_footer();
?>