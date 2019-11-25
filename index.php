<?php 
    session_cache_expire(65);
    session_start();
    if(!empty($_SESSION)){
        header("Location: ./inc/home.php");
    }
    echo "<script> var erro = 2</script>";
    include("./inc/inc.db_connection.php");
    if(isset($_POST['usuario'])){
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
    
        $sql = mysqli_query($conexao, "SELECT * FROM admin WHERE nome='$usuario' AND senha='$senha'");
        if(mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_assoc($sql)){
                $_SESSION['id'] = $row['id'];
            };
            echo '<script type="text/javascript"> var erro = 0; </script>';
            $_SESSION['usuario'] = $usuario;
        }else{
            echo '<script type="text/javascript"> var erro = 1; </script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/logar.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="./sweetalert2/dist/sweetalert2.min.css">
    <title>Login|SoftXD</title>
</head>
<body>
    <section class="area-login-adm">
        <div class="login-adm animated fadeIn">
            <h3 class="title-login">SoftXD Login</h3>
            <form class="form-adm" method="POST">
                <label for="">Usuario</label>
                <div class="campos-form">
                    <input class="inputs-adm input-user" id="usuario" name="usuario" placeholder="Digite seu nome" required>
                </div>
                <label for="">Senha</label>
                <div class="campos-form">
                    <input class="inputs-adm input-senha" type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>
                <button class="btn-logar" type="submit">Logar</button>
            </form>
        </div>
    </section>
</body>
<script src="./sweetalert2/dist/sweetalert2.min.js"></script>
<script>
    if(erro == 0){
        swal.fire({
            title: "Bem-Vindo !",
            text: "Logado com sucesso !",
            type: "success"
        }).then(function() {
            window.location = "./inc/home.php";
        });
        erro = 2;
    }else if(erro == 1){
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000
        }); 

        Toast.fire({
            type: "error",
            title: "Login ou Senha Invalidos !"
        }) 
        erro = 2;
    }
</script>
</html>