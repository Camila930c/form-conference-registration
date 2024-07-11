<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir y sanitizar los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];
    $emailP = $_POST['emailP'];
    $emailI = $_POST['emailI'];
    $institucion = $_POST['institucion'];
    $direccion = $_POST['direccion'];
    $celular = $_POST['celular'];
    $provincia = $_POST['provincia'];
    $ciudad = $_POST['ciudad'];
    $codigo = $_POST['codigo'];
    $nivel = $_POST['nivel'];
    $checkbox = isset($_POST['checkbox']) ? 1 : 0;
    $tipoIdentificacion = $_POST['T_identificacion'];
    $tipoInstitucion = $_POST['T_institucion'];
    $pais = $_POST['pais'];
    $tipoParticipacion = $_POST['opcion'];

    // Insertar en la tabla instituciones si no existe
    $insertarInstitucion = "INSERT IGNORE INTO instituciones (ID, TipoInstitucionesID, Nombre) VALUES ('', '$tipoInstitucion', '$institucion')";
    $conn->query($insertarInstitucion);

    // Insertar en la tabla usuarios
    $insertarUsuario = "INSERT INTO usuarios (TipoIdentificaciónID, Identificación, Nombres, Apellidos, FechaNacimiento, CorreoPersonal, CorreoInstitucional, InstituciónID, Dirección, Celular, PaísID, Provincia, Ciudad, CódigoPostal, NivelEstudios, FacturarOtraPersona)
                        VALUES ('$tipoIdentificacion', 'Identificación', '$nombre', '$apellido', '$fecha', '$emailP', '$emailI', '$tipoInstitucion', '$direccion', '$celular', '$pais', '$provincia', '$ciudad', '$codigo', '$nivel', '$checkbox')";

    if ($conn->query($insertarUsuario) === TRUE) {
        $usuarioID = $conn->insert_id; // Obtener el ID del usuario insertado

        // Insertar en la tabla participación
        $insertarParticipacion = "INSERT INTO participación (UsuarioID, TipoParticipación) VALUES ('$usuarioID', '$tipoParticipacion')";
        $conn->query($insertarParticipacion);

        // Redireccionar después de la inserción exitosa
        header('Location: confirmacion.php');
        exit; // Asegurarse de que no se ejecute más código después de la redirección
    } else {
        echo "Error: " . $insertarUsuario . "<br>" . $conn->error;
    }
}

// Obtener las opciones de los selects
$tiposIdentificacion = getOptions('tiposidentificación');
$tiposInstitucion = getOptions('tipoinstituciones');
$paises = getOptions('países');
?>




<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Congreso CITIS 2024</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="header">
    <div class="header-content">
      <img src="logo.png" alt="Logo" width="40" height="40">
      <h3>Sistema de Eventos</h3>
    </div>
    <div class="flags">
      <img src="icon/ingles.png" alt="English" title="English">
      <img src="icon/espanol.png" alt="Español" title="Español">
    </div>
  </div>

  <div class="container">
    <div class="tittle">
      <h5>CONGRESO</h5>
    </div>

    <h1>Congreso Internacional de Ciencia, Tecnología e Innovación para la Sociedad CITIS 2024</h1>
    <div class="info">
      <p><strong>GUAYAQUIL - MARIA AUXILIADORA</strong></p>
      <p>Desde: mié, 17 jul 2024 Al: vie, 19 jul 2024</p>
      <p>Horario: 09:00 a 18:00</p>
      <p>Total Horas: 24</p>
      <p>Fecha de Finalización de Inscripción: lun, 22 jul 2024</p>
    </div>

    <form action="#" name="prueba" method="post">
      <fieldset class="form-section1">
        <label for="tipo-identificacion">Tipo Identificación:</label>

        <select name="T_identificacion" id="tipo-identificacion" required>
          <option value="" disabled selected>Seleccione una opción</option>
          <?php foreach ($tiposIdentificacion as $tipo): ?>
            <option value="<?= $tipo['ID'] ?>"><?= $tipo['Descripcion'] ?></option>
          <?php endforeach; ?>
        </select>


        <label for="identificacion">Identificación:</label>
        <input type="text" id="identificacion" required>

        <label for="nombres">Nombres:</label>
        <input name="nombre" type="text" id="nombres" required>

        <label for="apellidos">Apellidos:</label>
        <input name="apellido" type="text" id="apellidos" required>

        <label for="fecha-nacimiento">Fecha Nacimiento:</label>
        <input name="fecha" type="date" id="fecha-nacimiento" required>

        <label for="correo-personal">Correo Personal:</label>
        <input name="emailP" type="email" id="correo-personal" required>

        <label for="correo-institucional">Correo Institucional:</label>
        <input name="emailI" type="email" id="correo-institucional">

        <label for="tipo-institucion">Tipo Institución:</label>
        <select name="T_institucion" id="tipo-institucion">
          <option value="" disabled selected>Seleccione una opción</option>
          <?php foreach ($tiposInstitucion as $institucion): ?>
            <option value="<?= $institucion['ID'] ?>"><?= $institucion['Nombre'] ?></option>
          <?php endforeach; ?>
        </select>

        <label for="institucion">Institución:</label>
        <input name="institucion" type="text" id="institucion" required>

        <label for="direccion">Dirección:</label>
        <input name="direccion" type="text" id="direccion" required>

        <label for="celular">Celular:</label>
        <input name="celular" type="tel" id="celular" required>

        <label for="pais">País:</label>
        <select name="pais" id="pais" required>
          <option value="" disabled selected>Seleccione una opción</option>
            <?php foreach ($paises as $pais): ?>
                        <option value="<?= $pais['ID'] ?>"><?= $pais['Nombre'] ?></option>
            <?php endforeach; ?>
          </select>

        <label for="provincia">Provincia:</label>
        <input name="provincia" type="text" id="provincia">

        <label for="ciudad">Ciudad:</label>
        <input name= "ciudad" type="text" id="ciudad" required>

        <label for="codigo-postal">Código Postal:</label>
        <input name= "codigo" type="text" id="codigo-postal">

        <label for="nivel-estudios">Nivel de Estudios:</label>
        <div>
          <textarea name= "nivel" id="nivel-estudios" rows="3" maxlength="500"></textarea>
          <label id="char-count">500 caracteres restantes</label>

        </div>

        <label>Facturar a nombre de otra persona o institución?:</label>
        <input name= "checkbox" type="checkbox" id="bill" name="bill">
      </fieldset>

      <fieldset class="form-section2">
        <label>Seleccione una opción:</label>
        <label><input type="radio" name="opcion" value="400" required> $ 400.0 PONENTE PROFESIONAL</label>
        <label><input type="radio" name="opcion" value="320"> $ 320.0 PONENTE DOCENTE UNIVERSITARIO</label>
        <label><input type="radio" name="opcion" value="200"> $ 200.0 PONENTE ESTUDIANTE EXTERNO</label>
        <label><input type="radio" name="opcion" value="0"> $ 0.0 PONENTE DOCENTE O ESTUDIANTE UPS</label>
        <label><input type="radio" name="opcion" value="15"> $ 15.0 ASISTENTE CON CERTIFICADO (NO PONENTE)</label>
        <label><input type="radio" name="opcion" value="0"> $ 0.0 ASISTENTE SIN CERTIFICADO (NO PONENTE)</label>
        <label><input type="radio" name="opcion" value="150"> $150 PONENTE PROFESIONAL</label>

      </fieldset>
      <fieldset class="form-section2">
        <div class="text-container">
          <strong>* Protección de datos personales:</strong>

          <br><br>
          De conformidad con lo dispuesto en la Ley Orgánica de Protección de Datos y su Reglamento General de
          Protección de datos, le informamos que sus datos personales serán tratados por la Universidad Politécnica
          Salesiana, domiciliada en la calle Turuhuayco 3-69 y Calle Vieja, en calidad de Responsable de Tratamiento con
          la finalidad de registrar su inscripción al Congreso Internacional de Ciencia, Tecnología e Innovación para la
          Sociedad CITIS 2024 que se desarrollará en el Campus María Auxiliadora, Km 19 vía a la costa - Guayaquil, del
          17-07-2024 hasta 19-07-2024.<br><br>

          La base jurídica que habilita a la Universidad para el tratamiento de este tipo de datos de carácter es el
          consentimiento expreso del asistente para el tratamiento de sus datos siendo este consentimiento obligatorio
          para poder ser inscrito al programa: "Congreso Internacional de Ciencia, Tecnología e Innovación para la
          Sociedad CITIS 2024".<br><br>

          Sus datos personales no serán cedidos por la Universidad a terceros salvo por obligación legal.
          Adicionalmente, le indicamos que sus datos personales se conservarán únicamente hasta que finalice el
          programa: "Congreso Internacional de Ciencia, Tecnología e Innovación para la Sociedad CITIS 2024" y
          posteriormente se conservarán bloqueados durante los plazos establecidos legalmente para atender a las
          posibles responsabilidades originadas del tratamiento de los mismos.<br><br>

        </div>

        <div class="actions">
          <div>
            <input type="checkbox" id="consent">
            <label for="consent"></label>
          </div>
        </div>

      </fieldset>
      <div>
        <button name="registro" onclick="visualizarDatos()">Visualizar Datos</button>
        <button onclick="limpiarFormulario()">Limpiar</button>
      </div>
    </form>

  </div>
  <footer>
    <p>Universidad Politécnica Salesiana 2022. Derechos Reservados.</p>
    <img src="icon/salesiana_logo.png" alt="Salesiana Logo">
  </footer>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const textarea = document.getElementById('nivel-estudios');
      const charCount = document.getElementById('char-count');
      const maxChars = 500;

      textarea.addEventListener('input', function () {
        const remaining = maxChars - textarea.value.length;
        charCount.textContent = `${remaining} caracteres restantes`;
      });
    });
  </script>
</body>


</html>
