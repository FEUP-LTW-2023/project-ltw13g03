<?php
    require_once(__DIR__ . '/../templates/common.php');

    output_header();
?>

<section id="register">
    <h1>Register</h1>
    <form>
    <label>
        <input type="file" name="photo" accept="image/*">
        <img src="https://cdn2.iconfinder.com/data/icons/dottie-user-part-1/24/user_024-add-profile-account-people-plus-new-512.png" alt="user_image">
    </label>
    <div id="user_info">
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
    </div>
    <button type="submit">Register</button>
    </form>
</section>

<?php
    output_footer();

?>