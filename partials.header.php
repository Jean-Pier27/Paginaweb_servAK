<?php require_once __DIR__ . '/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo setting('business_name'); ?></title>
  <link rel="icon" href="assets/img/5.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="assets/css/design.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2 brand-badge" href="index.php">
      <img src="assets/img/5.jpg" alt="Logo">
      <span class="fw-bold"><?php echo setting('business_name'); ?></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
        <li class="nav-item"><a class="nav-link" href="#zonas">Zonas de servicio</a></li>
        <li class="nav-item"><a class="nav-link" href="#opiniones">Reseñas</a></li>
        <li class="nav-item"><a class="nav-link" href="#trabajos">Nuestro trabajo</a></li>
        <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
        <li class="nav-item"><a class="btn btn-primary btn-sm ms-lg-2" href="https://wa.me/<?php echo preg_replace('/\D+/', '', setting('whatsapp')); ?>" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a></li>
      </ul>
    </div>
  </div>
</nav>