<?php
    require_once('templates/common.php');

    output_header();
?>

<section id="login">
    <h1>Login</h1>
    <form>
    <label>
        Username <input type="text" name="username">
    </label>
    <label>
        Password <input type="password" name="password">
    </label>
    <button type="submit">Login</button>
    </form>
</section>

<?php
    output_footer();

?>