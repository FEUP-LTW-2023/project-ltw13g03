<?php
    require_once(__DIR__ . '/../database/users.php');
    function output_user_profile() {
        $user = getUserInfo($_SESSION['username']) ?>
        <section class="userprofile">
            <h2>Profile</h2>
            <form action="../actions/update_user_info.php" method="post" enctype="multipart/form-data">
                <label id="name">
                    Name <input type="text" required name="name" value="<?php echo $user['name']; ?>">
                </label>
                <label id="email">
                    E-mail <input type="email" name="email" value="<?php echo $user['email']; ?>">
                </label>
                <label id="newpassword">
                    Password <input type="password" name="password">
                </label>
                <label id="repeatpassword">
                    Repeat password <input type="password" name="password">
                </label>
                <div id="photo">
                    <img src="../images/default.jpg" alt="user_image">
                    <input type="file" id="profile-input" accept="image/png,image/jpeg">
                    <label for="profile-input" id="newphoto">Upload photo</label>
                </div>
                <button type="submit">Update info</button>
            </form>
        </section>
    <?php }
?>
