<?php
    require_once('../templates/common.php');

    output_header();
?>

<section id="register">
    <h1>Register</h1>
    <form>
    <label>
        Name <input type="text" name="name">
    </label>
    <label>
        Username <input type="text" name="username">
    </label>
    <label>
        E-mail <input type="email" name="email">
    </label>
    <label>
        Password <input type="password" name="password">
    </label>
    <label>
        Password <input type="password" name="password">
    </label>
    <button type="submit">Register</button>
    </form>
</section>

<?php
    output_footer();

?>