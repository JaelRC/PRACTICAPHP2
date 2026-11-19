<?php
$datos = [
    "nombre" => "",
    "correo" => "",
    "mensaje" => ""
];

$errores = [];
$enviado = false;

if (isset($_POST["enviar"])) {

    $datos["nombre"] = trim($_POST["nombre"]);
    $datos["correo"] = trim($_POST["correo"]);
    $datos["mensaje"] = trim($_POST["mensaje"]);

    // Nombre
    if (empty($datos["nombre"])) {
        $errores["nombre"] = "Por favor ingresa un nombre.";
    }

    // Correo
    if (empty($datos["correo"])) {
        $errores["correo"] = "Por favor ingresa un correo.";
    } else if (!filter_var($datos["correo"], FILTER_VALIDATE_EMAIL)) {
        $errores["correo"] = "Por favor ingresa un correo válido.";
    }

    // Mensaje
    if (empty($datos["mensaje"])) {
        $errores["mensaje"] = "Por favor ingresa el mensaje.";
    }

    if (empty($errores)) {
        $enviado = true;

        $datos = [
            "nombre" => "",
            "correo" => "",
            "mensaje" => ""
        ];
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Formulario de contacto</title>
</head>

<body>
    <form class="formulario" method="post" novalidate>

        <!-- Nombre -->
        <div class="campo <?php echo isset($errores["nombre"]) ? "campo-error" : ""; ?>">
            <input type="text" name="nombre" placeholder="Nombre:" value="<?php echo htmlspecialchars($datos["nombre"]); ?>">
        </div>

        <!-- Correo -->
        <div class="campo <?php echo isset($errores["correo"]) ? "campo-error" : ""; ?>">
            <input type="email" name="correo" placeholder="Correo:" value="<?php echo htmlspecialchars($datos["correo"]); ?>">
        </div>

        <!-- Mensaje -->
        <div class="campo <?php echo isset($errores["mensaje"]) ? "campo-error" : ""; ?>">
            <textarea name="mensaje" placeholder="Mensaje:"><?php echo htmlspecialchars($datos["mensaje"]); ?></textarea>
        </div>

        <?php if ($enviado) { ?>

            <p class="estado estado-ok">Enviado correctamente.</p>

        <?php } else if (!empty($errores)) { ?>

            <div class="estado estado-error">
                <?php foreach ($errores as $error) { ?>
                    <?php echo $error; ?><br>
                <?php } ?>
            </div>

        <?php } ?>

        <button type="submit" name="enviar">Enviar Correo</button>
    </form>
</body>
</html>