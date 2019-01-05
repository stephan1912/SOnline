<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/style.css">
        <title>SOnline</title>
    </head>
    <body>
        <?php 
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $navbar = array(0, 0, 0, 1);
            require 'componente/navbar.php';
            $conn = new mysqli('localhost', 'root', '1997', 'fsonline');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $eror = "";
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(isset($_POST["btnLogin"])){
                    $user = $_POST["numeLogin"];
                    $pass = $_POST["passLogin"];
                    $sql = "SELECT id, nume from utilizatori where nume='".$user."' and parola='".$pass."'";
                    $eror = $sql;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $_SESSION["id_user"] = $row["id"];
                            $_SESSION["nume_user"] = $row["nume"];
                            header("Location: index.php");
                            die();
                        }
                    }
                    else{
                        $eror = "<p style='color:red'>Numele de utilizator sau parola sunt incorecte!</p>";
                    }
                }
                else if(isset($_POST["btnRegister"])){
                    $user = $_POST["numeReg"];
                    $pass = $_POST["passReg"];
                    $email = $_POST["emailReg"];

                    $sql = "INSERT INTO utilizatori (nume, email, parola) values('".$user."','".$email."','".$pass."')";
                    $conn->query($sql);
                    $last_id = $conn->insert_id;
                    $_SESSION["id_user"] = $row["id"];
                    $_SESSION["nume_user"] = $user;
                    header("Location: index.php");
                    die();
                }
            }
        ?>
        <div id="pageContent" class="contentBox">
            <div style="width:350px;margin-left:auto;margin-right:auto;margin-top:50px;">
                <header>
                    <button class="fs_button_activ" style="display:inline-block;" id="btnArataLogin">
                        Autentificare
                    </button>
                    <button class="fs_button" style="display:inline-block;" id="btnArataRegister">
                        Inregistrare
                    </button>
                </header>
                <form id="formLogin" method="POST" style="margin-top:10px;">
                    <table>
                        <tr>
                            <td>
                                <label>Nume utilizator:</label>
                            </td>
                            <td>
                                <input class="fs_input" name="numeLogin"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Parola:</label>
                            </td>
                            <td>
                                <input type="password" class="fs_input" name="passLogin"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Conectare" class="fs_button" name="btnLogin"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <form id="formRegister" method="post" style="display:none;margin-top:10px;">
                <table>
                        <tr>
                            <td>
                                <label>Nume utilizator:</label>
                            </td>
                            <td>
                                <input class="fs_input" name="numeReg"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>E-mail:</label>
                            </td>
                            <td>
                                <input class="fs_input" name="emailReg"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Parola:</label>
                            </td>
                            <td>
                                <input type="password" class="fs_input" name="passReg"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Creeaza cont" class="fs_button" name="btnRegister"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <?=$eror?>
            </div>
        </div>
        <script src="js/login.js"></script>
    </body>
</html>