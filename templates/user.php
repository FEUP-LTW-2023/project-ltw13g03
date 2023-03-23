<?php
    function get_user_profile() {
        return array(
            "name" => "Cristiano Ronaldo",
            "username" => "cr7",
            "email" => "cr7@email.com",
            "image" => "https://wompampsupport.azureedge.net/fetchimage?siteId=7575&v=2&jpgQuality=100&width=700&url=https%3A%2F%2Fi.kym-cdn.com%2Fentries%2Ficons%2Ffacebook%2F000%2F039%2F281%2Fbrrr.jpg"
        );
    }
    function output_user_profile() {
        $user = get_user_profile() ?>
        <section class="userprofile">
            <img src="<?php echo $user['image']; ?>">
            <h2><?php echo $user['name']; ?></h2>
            username: <?php echo $user['username']; ?> <br>
            e-mail: <?php echo $user['email']; ?> <br>
        </section>
    <?php }
?>
