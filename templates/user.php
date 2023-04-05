<?php
    function get_user_profile() {
        return array(
            "name" => "Cristiano Ronaldo",
            "username" => "cr7",
            "email" => "cr7@email.com",
            "image" => "https://picsum.photos/120/120"
        );
    }
    function output_user_profile() {
        $user = get_user_profile() ?>
        <section class="userprofile">
            <h2>Profile</h2>
            <form>
                <label id="name">
                    Name <input type="text" required name="name" value="<?php echo $user['name']; ?>">
                </label>
                <label id="username">
                    Username <input type="text" name="username" value="<?php echo $user['username']; ?>">
                </label>
                <label id="email">
                    E-mail <input type="email" name="email" value="<?php echo $user['email']; ?>">
                </label>
                <label id="birthday">
                    Birthday <input type="date" name="birthday" id="birthday">
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
                    <img src="<?php echo $user['image'];?>" alt="user_image">
                </div>
                    <button>Update info</button>
            </form>
        </section>
    <?php }
?>
