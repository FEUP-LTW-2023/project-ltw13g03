<?php
    require_once(__DIR__ . '/../database/users.php');
    function output_user_profile() {
        $user = getUserInfo($_SESSION['username']) ?>
        <section class="userprofile">
            <h2>Profile</h2>
            <form>
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
                    <label id="newphoto">
                        <input type="file" name="photo" accept="image/*">
                        Upload photo
                    </label>
                    <img src="<?php echo "https://picsum.photos/120/120";?>" alt="user_image">
                </div>
                <button>Update info</button>
            </form>
        </section>
    <?php }
?>
