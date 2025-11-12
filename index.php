<?php include 'partials.header.php'; ?>
<main class="container my-5">

  <section class="py-5">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <h1 class="display-4 fw-bold"><?php echo nl2br(htmlspecialchars(setting('hero_title'))); ?></h1>
            
          <p class="lead mb-4"><?php echo nl2br(htmlspecialchars(setting('hero_subtitle'))); ?></p>
            
          <div class="cta d-flex flex-wrap gap-2">
            <a class="btn btn-light btn-lg" href="#contacto">Solicitar cotización</a>
            <a class="btn btn-outline-light btn-lg" href="#servicios">Ver servicios</a>
          </div>
            
          <div class="mt-4 d-flex align-items-center gap-3">
            <a class="text-white fs-4" href="<?php echo setting('facebook'); ?>" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a>
            <a class="text-white fs-4" href="<?php echo setting('instagram'); ?>" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a>
            <a class="text-white fs-4" href="<?php echo setting('tiktok'); ?>" target="_blank" title="TikTok"><i class="bi bi-tiktok"></i></a>
          </div>
        </div>
        <div class="col-lg-5">
          <img class="w-100" src="assets/img/principal.png" alt="Imagen principal de la empresa">
        </div>
      </div>
    </div>
  </section>

  <section id="servicios" class="mb-5">
    <div class="section-title mb-3">
      <h2 class="h3 m-0">Nuestros servicios</h2>
      <div class="sub">Calidad, eficiencia y confianza.</div>
    </div>
    <div class="row g-4">
      <?php
        $pdo = db();
        $stmt = $pdo->query("SELECT * FROM services WHERE is_active=1 ORDER BY id LIMIT 8");
        foreach ($stmt as $svc):
      ?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h3 class="h5"><?php echo htmlspecialchars($svc['title']); ?></h3>
            <p class="mb-2"><?php echo htmlspecialchars($svc['description']); ?></p>
            <?php if (!is_null($svc['price'])): ?>
              <span class="badge text-bg-primary">Desde S/ <?php echo number_format($svc['price'],2); ?></span>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section id="zonas" class="mb-5">
    <div class="section-title mb-3">
      <h2 class="h3 m-0">Zonas de servicio</h2>
      <div class="sub">Cobertura en Lima</div>
    </div>
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-6">
        <div class="p-3 rounded-4 shadow-sm" style="background: rgba(255,255,255,.02); border:1px solid rgba(255,255,255,.06);">
          <div class="d-flex flex-wrap gap-2">
            <?php
              $zonas = ["Chaclacayo","La Planicie","Barranco","Chosica","Santa Anita","Santiago de Surco","Los Olivos","San Borja","La Molina","Comas"];
              foreach ($zonas as $z) {
                echo '<span class="badge rounded-pill badge-zone px-3 py-2">'.$z.'</span>';
              }
            ?>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
          <iframe src="https://www.google.com/maps?q=Lima,+Peru&output=embed" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </section>

  <section id="opiniones" class="mb-5">
    <div class="section-title mb-3">
      <h2 class="h3 m-0">Reseñas</h2>
      <div class="sub">Reseñas positivas de nuestro servicio</div>
    </div>
    <div class="row g-4">
      <?php
        $reviews = [
          ["name"=>"María G.","text"=>"Excelente servicio, dejaron mi sofá como nuevo. Puntuales y muy amables."],
          ["name"=>"Carlos R.","text"=>"La limpieza de colchón quedó impecable. 100% recomendados."],
          ["name"=>"Ana P.","text"=>"Rápidos y profesionales. Mi auto quedó sin olores y súper limpio."],
        ];
        foreach($reviews as $rv):
      ?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="mb-2 text-warning">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="mb-2"><?php echo htmlspecialchars($rv['text']); ?></p>
            <div class="small text-muted">— <?php echo htmlspecialchars($rv['name']); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section id="trabajos" class="mb-5">
    <div class="section-title mb-3">
      <h2 class="h3 m-0">Nuestro trabajo en acción</h2>
    </div>
    <div class="row g-4">
      <?php
        $stmt = $pdo->query("SELECT * FROM portfolio WHERE is_active=1 ORDER BY id LIMIT 6");
        foreach ($stmt as $item):
      ?>
      <div class="col-md-4">
        <div class="media-pad rounded-4 shadow-sm h-100">
          <?php if ($item['type'] === 'image'): ?>
            <div class="media-frame"><img class="w-100" src="<?php echo htmlspecialchars($item['file_path']); ?>" alt=""></div>
          <?php else: ?>
            <div class="media-frame"><video class="w-100" controls playsinline>
              <source src="<?php echo htmlspecialchars($item['file_path']); ?>" type="video/mp4">
            </video></div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section id="contacto" class="mb-5">
    <div class="section-title mb-3">
      <h2 class="h3 m-0">Pide tu cotización</h2>
    </div>
    <?php if (isset($_GET['ok'])): ?>
      <div class="alert alert-success">¡Gracias! Te contactaremos pronto.</div>
    <?php endif; ?>
    <form class="row g-3" method="post" action="contact_submit.php">
      <div class="col-md-6">
        <label class="form-label">Nombres</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Teléfono</label>
        <input type="text" maxlength="9" name="phone" class="form-control">
      </div>
      <div class="col-md-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
      </div>
      <div class="col-12">
        <label class="form-label">Mensaje</label>
        <textarea name="message" class="form-control" rows="4" required></textarea>
      </div>
      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit">Enviar</button>
        <a class="btn btn-outline-light" href="https://wa.me/<?php echo preg_replace('/\D+/', '', setting('whatsapp')); ?>" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
      </div>
    </form>
  </section>
</main>
<?php include 'partials.footer.php'; ?>
