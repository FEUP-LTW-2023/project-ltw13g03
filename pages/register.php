<?php
    session_start();

    if(isset($_SESSION['username'])){
        header("Location: /");
    }

    require_once(__DIR__ . '/../templates/common.php');

    output_header(false);
?>

<section id="register">
    <h1>Register</h1>
    <form action="../actions/action_register.php" method="post" enctype="multipart/form-data">
    <label>
        <input type="file" name="profile-input" accept="image/png,image/jpeg">
        <img src="https://cdn2.iconfinder.com/data/icons/dottie-user-part-1/24/user_024-add-profile-account-people-plus-new-512.png" alt="user_image">
    </label>
    <div id="user_info">
        <label>
            Name <input type="text" name="name">
            <span class="error"></span>
        </label>
        <label>
            Username <input type="text" name="username">
            <span class="error"></span>
        </label>
        <label>
            E-mail <input type="email" name="email">
            <span class="error"></span>
        </label>
        <label>
            Password <input type="password" name="password1">
            <span class="error"></span>
        </label>
        <label>
            Password <input type="password" name="password2">
            <span class="error"></span>
        </label>
    </div>
    <button type="submit">Register</button>
    </form>
</section>

<?php
    output_footer();

?>