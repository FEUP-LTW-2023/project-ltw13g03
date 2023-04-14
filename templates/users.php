<?php
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

                    ?>
                    <tr>
                        <td>
                            <div class="user_info">
                                <img src="https://picsum.photos/40/40" alt="">
                                <div class="username">
                                    <p>Ronaldo</p>
                                    <p>@ronaldinho</p>
                                </div>
                            </div>
                        </td>
                            <td>
                                <select>
                                    <option value="client">Client</option>
                                    <option value="agent">Agent</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </td>
                        <td>
                            <select>
                                <option value="hr">Human Resources</option>
                                <option value="it">Information Technology</option>
                                <option value="sales">Sales</option>
                                <option value="finance">Finance</option>
                                <option value="other">Other</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user_info">
                                <img src="https://picsum.photos/40/40" alt="">
                                <div class="username">
                                    <p>Messi</p>
                                    <p>@saco_do_lixo</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <select>
                                <option value="client">Client</option>
                                <option value="agent">Agent</option>
                                <option value="admin">Admin</option>
                            </select>
                        </td>
                        <td>
                            <select>
                                <option value="hr">Human Resources</option>
                                <option value="it">Information Technology</option>
                                <option value="sales">Sales</option>
                                <option value="finance">Finance</option>
                                <option value="other">Other</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    <?php }

    function output_user() { ?>
        <tr>
            <td>
                <div class="user_info">
                    <img src="https://picsum.photos/40/40" alt="">
                    <div class="username">
                        <p>Ronaldo</p>
                        <p>@ronaldinho</p>
                    </div>
                </div>
            </td>
                <td>
                    <select>
                        <option value="client">Client</option>
                        <option value="agent">Agent</option>
                        <option value="admin">Admin</option>
                    </select>
                </td>
            <td>
                <select>
                    <option value="hr">Human Resources</option>
                    <option value="it">Information Technology</option>
                    <option value="sales">Sales</option>
                    <option value="finance">Finance</option>
                    <option value="other">Other</option>
                </select>
            </td>
        </tr>
    <?php }
?>