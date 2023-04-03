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
            <img src="<?php echo $user['image']; ?>">
            <h2><?php echo $user['name']; ?></h2>
            <ul>
                <li><?php echo $user['username']; ?></li>
                <li><?php echo $user['email']; ?></li>
            </ul>
            <button>Update info</button>
        </section>
    <?php }
?>
