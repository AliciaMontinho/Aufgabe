<?php include_once("../includes/header_login.php"); ?>
<link rel="stylesheet" href="../assets/css/politicas.css">

<div class="container mt-4 mb-5 politicas-container">
  <div class="card shadow p-4" style="border-radius: 15px;">
    <h2 class="text-primary mb-3 fw-bold">
      <i class="bi bi-shield-lock me-2"></i>Políticas de Privacidad
    </h2>

    <p class="text-muted">
      Última actualización: <span id="fecha-actualizacion"></span>
    </p>

    <hr>

    <h4 class="fw-semibold mt-4">1. Información que recopilamos</h4>
    <p>Recopilamos datos personales como nombre, correo electrónico y rol del usuario. Esta información se utiliza exclusivamente para el funcionamiento del sistema de gestión de incidencias.</p>

    <h4 class="fw-semibold mt-4">2. Uso de los datos</h4>
    <p>Los datos proporcionados por los usuarios se utilizarán únicamente para:</p>
    <ul>
      <li>Gestión de incidencias.</li>
      <li>Asignación de técnicos.</li>
      <li>Mejoras del servicio interno.</li>
    </ul>

    <h4 class="fw-semibold mt-4">3. Seguridad</h4>
    <p>Todos los datos están protegidos mediante protocolos de seguridad y encriptación de contraseñas. El acceso está limitado a usuarios autorizados.</p>

    <div class="alert alert-info mt-4">
      <i class="bi bi-lock me-2"></i> Nunca compartimos tu información con terceros.
    </div>

    <h4 class="fw-semibold mt-4">4. Derechos del usuario</h4>
    <p>El usuario tiene derecho a:</p>
    <ul>
      <li>Solicitar acceso a sus datos.</li>
      <li>Modificar información personal.</li>
      <li>Solicitar la eliminación de su cuenta.</li>
    </ul>

    <h4 class="fw-semibold mt-4">5. Contacto</h4>
    <p>Si tienes dudas sobre nuestras políticas puedes contactarnos desde el formulario de contacto o enviarnos un correo oficial.</p>

    <div class="text-end mt-4">
      <a href="contacto.php" class="btn btn-outline-primary">
        <i class="bi bi-envelope"></i> Ir al formulario de contacto
      </a>
    </div>
  </div>
</div>


<script src="../assets/js/politicas.js"></script>

<?php include_once("../includes/footer.php"); ?>