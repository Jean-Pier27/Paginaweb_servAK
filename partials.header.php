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
  <style>
    :root {
      --bg1:#0d47a1;
      --bg2:#1976d2;
      --accent:#64b5f6;
      --text:#eaf2ff;
    }
    html, body { height: 100%; }
    body {
      font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans";
      color: var(--text);
      background: linear-gradient(180deg, #0b1f3a 0%, #0a1a32 100%);
      background-attachment: fixed;
    }
    .navbar {
      background: rgba(10, 26, 50, .8);
      backdrop-filter: blur(6px);
      border-bottom: 1px solid rgba(100,181,246,.15);
    }
    .navbar .nav-link { color: #cfe6ff; }
    .navbar .nav-link:hover { color: white; }
    .brand-badge img { height: 36px; width:auto; }
    .hero {
      background: radial-gradient(1200px 600px at 10% 0%, var(--bg2) 0%, transparent 60%),
                  radial-gradient(1200px 600px at 90% 0%, var(--bg1) 0%, transparent 60%);
      color: white;
      position: relative;
    }
    .hero .cta .btn { border-width: 2px; }
    .btn-primary { background: var(--bg2); border-color: var(--bg2); }
    .btn-primary:hover { background: var(--bg1); border-color: var(--bg1); }
    .btn-outline-light:hover { color:#0d47a1; background:#eaf2ff; border-color:#eaf2ff; }
    .section-title .sub { color:#a9c9ff; }
    .card, .media-pad { background: rgba(255,255,255,.02); border: 1px solid rgba(255,255,255,.06); color: var(--text); }
    .media-frame img, .media-frame video { border-radius: 1rem; display:block; }
    .badge-zone { background: rgba(100,181,246,.15); color: #cfe6ff; border:1px solid rgba(100,181,246,.25); }
    footer { background:#0b1220; color:#d8e0ff; border-top:1px solid rgba(100,181,246,.15); }
    footer a { color:#bcd0ff; }
  </style>
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

<section class="hero py-5">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <h1 class="display-6 fw-bold"><?php echo nl2br(htmlspecialchars(setting('hero_title'))); ?></h1>
        <p class="lead mb-4"><?php echo nl2br(htmlspecialchars(setting('hero_subtitle'))); ?></p>
        <div class="cta d-flex flex-wrap gap-2">
          <a class="btn btn-light btn-lg" href="#contacto">Solicitar cotización</a>
          <a class="btn btn-outline-light btn-lg" href="#servicios">Ver servicios</a>
        </div>
        <div class="mt-3 d-flex align-items-center gap-3">
          <a class="text-white" href="<?php echo setting('facebook'); ?>" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a>
          <a class="text-white" href="<?php echo setting('instagram'); ?>" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a>
          <a class="text-white" href="<?php echo setting('tiktok'); ?>" target="_blank" title="TikTok"><i class="bi bi-tiktok"></i></a>
        </div>
      </div>
      <div class="col-lg-5">
        <img class="w-100" src="assets/img/principal.png" alt="Imagen principal de la empresa" style="border-radius:1rem; box-shadow: 0 20px 60px rgba(0,0,0,.35);">
      </div>
    </div>
  </div>
</section>
