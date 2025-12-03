<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    include '../includes/header.php';
} else {
    include '../includes/header_login.php';
}
?>
<link rel="stylesheet" href="../assets/css/contacto.css">

<div class="container-contacto d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="card shadow p-4" style="width: 500px; border-radius: 20px;">
    <h3 class="text-center mb-4 text-primary">Contacto</h3>

    <form action="#" id="formContacto"    method="POST">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre">
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="tuemail@ejemplo.com">
      </div>

      <div class="mb-3">
        <label for="asunto" class="form-label">Asunto</label>
        <input type="text" class="form-control" id="asunto" name="asunto" placeholder="Motivo del mensaje">
      </div>

      <div class="mb-3">
        <label for="mensaje" class="form-label">Mensaje</label>
        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="Escribe tu mensaje aquí..."></textarea>
      </div>

      <button type="submit" class="btn btn-primary w-100">Enviar mensaje</button>
    </form>

    <p class="mt-3 text-center text-muted">
      ¿Necesitas ayuda adicional? <a href="politicas.php" class="text-decoration-none">Consulta nuestras políticas</a>
    </p>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script src="../assets/js/contacto.js"></script>
<script src="../assets/js/email.js"></script>

<?php include_once '../includes/footer.php'; ?>
