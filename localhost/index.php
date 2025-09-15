<?php require_once 'templates/header.php' ?>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Password</th>
            </tr>
            <?php
                $data = query("SELECT*FROM 'user'");
                foreach ($data as $user) {
                    $id =$user["id_user"];
                    $login =$user["login"];
                    $password =$user["password"];
                    echo"
                        <tr>
                            <td>$id</th>
                            <td>$login</th>
                            <td>$password</th>
                        </tr>
                    ";
                }
            ?>
        </table>
    </main>
<?php require_once 'templates/footer.php' ?>