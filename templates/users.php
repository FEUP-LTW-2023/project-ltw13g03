<?php
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/client.class.php');
    require_once(__DIR__ . '/../database/misc.php');

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
        <tr data-id=<?=$user->username?>>
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
                    <option value="agent" <?= (!$user->isAdmin && $user->isAgent) ? 'selected' : '' ?>>Agent</option>
                    <option value="admin" <?= $user->isAdmin ? 'selected' : '' ?>>Admin</option>
                </select>
            </td>
            <td>
                <div class="departments">
                    <ul>
                        <?php
                        $departmentsUser = $user->departments;
                        foreach ($departmentsUser as $departmentUser) { ?>
                            <li ><?=$departmentUser['name']?></li>
                        <?php } ?>
                    </ul>

                    <select>
                        <option value="unspecified" selected>+</option>
                        <?php 
                        $departments = getDepartments();
                        foreach ($departments as $department) { ?>
                            <option><?=$department['name']?></option>
                        <?php } ?>
                    </select>
                </div>
            </td>
        </tr>
    <?php }
?>