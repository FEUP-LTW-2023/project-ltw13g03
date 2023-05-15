<?php
session_start();

    if(isset($_SESSION['username'])){
        die(header("Location: /"));
    }

    require_once(__DIR__ . '/../templates/common.php');

    output_header(false);
?>

<section id="register">
    <h1>Register</h1>
    <form action="../actions/action_register.php" method="post" enctype="multipart/form-data">
    <label>
        <input type="file" name="profile-input" accept="image/png,image/jpeg">
        <img src="../images/icons/add_picture.png" alt="user_image">
    </label>
    <div id="user_info">
        <label>
            Name <input type="text" name="name">
            <span class="error"><?=$_SESSION['errors']['name']?></span>
        </label>
        <label>
            Username <input type="text" name="username">
            <span class="error"><?=$_SESSION['errors']['name']?></span>
        </label>
        <label>
            E-mail <input type="email" name="email">
            <span class="error"><?=$_SESSION['errors']['email']?></span>
        </label>
        <label>
            Password <input type="password" name="password1">
            <span class="error"><?=$_SESSION['errors']['password1']?></span>
        </label>
        <label>
            Password <input type="password" name="password2">
            <span class="error"><?=$_SESSION['errors']['password2']?></span>
        </label>
    </div>
    <button type="submit">Register</button>
    </form>
    <span class="error"><?=$_SESSION['errors']['undefined']?></span>
    <span id="already_registered">Already have an account? Click <a href="login.php">here</a> to sign in!</span>
</section>

<?php
    output_footer();

?>