<?php


if(isset($_POST['inicioSesion'])){
    if(strlen($_POST['Nusuario'])>=1 && strlen ($_POST['Pass'])>=1) {
        
        $NombreUsuario=$_POST['Nusuario'];
        $Contra=$_POST['Pass'];

        include './conexion.php';

        $consulta=mysqli_query($conexion,"SELECT * FROM usuarios WHERE 
        username='$NombreUsuario' AND password='$Contra' ");

        $detalles=mysqli_fetch_array($consulta);

        if ($detalles){
            session_start();
            $_SESSION['usuario_id'] = $detalles['id'];
            $_SESSION['usuario'] = $detalles['username'];
            $_SESSION['tipo_usuario'] = $detalles['tipo_usuario'];

            if ($_SESSION['tipo_usuario'] == 'cliente'){
                header("Location:views/landing.php");
            }

            if ($_SESSION['tipo_usuario'] == 'tatuador'){
                header("Location:views/panel_tatuador.php");
            }

            if ($_SESSION['tipo_usuario'] == 'admin'){
                header("Location:views/panel_admin.php ");
            }

            
        }
        else{
            echo "Usuario no existe";
        }
        

    }
    else{
        echo "Complete los campos";
    }


    
}

?>