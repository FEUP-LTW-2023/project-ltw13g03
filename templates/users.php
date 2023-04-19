<?php
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.class.php');

    function output_users() { ?>
    
        <section id="form-manage-users">
            <table id="manage-users">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $db = getDatabaseConnection();
                        $users = Client::getAllUsers($db);
                        foreach ($users as $user) {
                            output_user($user);
                        }
                    ?>
                </tbody>
            </table>
        </section>
    <?php }

    function output_user($user) { ?>
        <tr>
            <td>
                <div class="user_info">
                    <img src="https://picsum.photos/40/40" alt="">
                    <div class="username">
                        <p><?=$user->name?></p>
                        <p>@<?=$user->username?></p>
                    </div>
                </div>
            </td>
                <td>
                    <select>
                        <option value="client">Client</option>
                        <option value="agent" <?= (!$user->isAgent && $user->isAdmin) ? 'selected' : '' ?>>Agent</option>
                        <option value="admin" <?= $user->isAdmin ? 'selected' : '' ?>>Admin</option>
                    </select>
                </td>
            <td>
                <select>
                    <option value="hr">Human Resources</option>
                    <option value="it">Information Technology</option>
                    <option value="sales">Sales</option>
                    <option value="finance">Finance</option>
                    <option value="none" selected>None</option>
                    <option value="other">Other</option>
                </select>
            </td>
        </tr>
    <?php }
?>