<?php
require_once __DIR__ . '/../db.php';
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
$pdo = db();

if (isset($_POST['action']) && $_POST['action']==='save_service') {
  if (!empty($_POST['id'])) {
    $stmt=$pdo->prepare("UPDATE services SET title=?, description=?, price=? WHERE id=?");
    $stmt->execute([$_POST['title'], $_POST['description'], $_POST['price']!==''?$_POST['price']:null, $_POST['id']]);
  } else {
    $stmt=$pdo->prepare("INSERT INTO services (title, description, price) VALUES (?,?,?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $_POST['price']!==''?$_POST['price']:null]);
  }
  header("Location: dashboard.php#servicios"); exit;
}
if (isset($_GET['del_service'])) {
  $stmt=$pdo->prepare("DELETE FROM services WHERE id=?");
  $stmt->execute([$_GET['del_service']]);
  header("Location: dashboard.php#servicios"); exit;
}
if (isset($_POST['action']) && $_POST['action']==='add_portfolio') {
  $stmt=$pdo->prepare("INSERT INTO portfolio (type, file_path, caption) VALUES (?,?,?)");
  $stmt->execute([$_POST['type'], $_POST['file_path'], $_POST['caption']]);
  header("Location: dashboard.php#portafolio"); exit;
}
if (isset($_GET['del_item'])) {
  $stmt=$pdo->prepare("DELETE FROM portfolio WHERE id=?");
  $stmt->execute([$_GET['del_item']]);
  header("Location: dashboard.php#portafolio"); exit;
}
if (isset($_POST['action']) && $_POST['action']==='save_settings') {
  $stmt=$pdo->query("SELECT id FROM settings ORDER BY id DESC LIMIT 1");
  $row=$stmt->fetch();
  if ($row) {
    $stmt=$pdo->prepare("UPDATE settings SET business_name=?, hero_title=?, hero_subtitle=?, address=?, whatsapp=?, facebook=?, instagram=?, tiktok=?, yape=?, plin=? WHERE id=?");
    $stmt->execute([$_POST['business_name'], $_POST['hero_title'], $_POST['hero_subtitle'], $_POST['address'], $_POST['whatsapp'], $_POST['facebook'], $_POST['instagram'], $_POST['tiktok'], $_POST['yape'], $_POST['plin'], $row['id']]);
  } else {
    $stmt=$pdo->prepare("INSERT INTO settings (business_name, hero_title, hero_subtitle, address, whatsapp, facebook, instagram, tiktok, yape, plin) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->execute([$_POST['business_name'], $_POST['hero_title'], $_POST['hero_subtitle'], $_POST['address'], $_POST['whatsapp'], $_POST['facebook'], $_POST['instagram'], $_POST['tiktok'], $_POST['yape'], $_POST['plin']]);
  }
  header("Location: dashboard.php#ajustes"); exit;
}

$services = $pdo->query("SELECT * FROM services ORDER BY id")->fetchAll();
$portfolio = $pdo->query("SELECT * FROM portfolio ORDER BY id")->fetchAll();
$stmt = $pdo->query("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
$settings = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="es"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Panel de administración</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-dark text-light">
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Panel de administración</h1>
    <a class="btn btn-outline-light btn-sm" href="../index.php">Ver sitio</a>
  </div>

  <div class="row g-4">
    <div class="col-lg-6">
      <div class="card bg-body-tertiary">
        <div class="card-body">
          <h2 id="ajustes" class="h5">Ajustes</h2>
          <form method="post">
            <input type="hidden" name="action" value="save_settings">
            <div class="row g-2">
              <div class="col-md-6"><label class="form-label">Nombre</label><input class="form-control" name="business_name" value="<?php echo htmlspecialchars($settings['business_name']??''); ?>"></div>
              <div class="col-md-6"><label class="form-label">WhatsApp</label><input class="form-control" name="whatsapp" value="<?php echo htmlspecialchars($settings['whatsapp']??''); ?>"></div>
              <div class="col-md-12"><label class="form-label">Hero título</label><textarea class="form-control" name="hero_title" rows="2"><?php echo htmlspecialchars($settings['hero_title']??''); ?></textarea></div>
              <div class="col-md-12"><label class="form-label">Hero subtítulo</label><textarea class="form-control" name="hero_subtitle" rows="2"><?php echo htmlspecialchars($settings['hero_subtitle']??''); ?></textarea></div>
              <div class="col-md-6"><label class="form-label">Facebook</label><input class="form-control" name="facebook" value="<?php echo htmlspecialchars($settings['facebook']??''); ?>"></div>
              <div class="col-md-6"><label class="form-label">Instagram</label><input class="form-control" name="instagram" value="<?php echo htmlspecialchars($settings['instagram']??''); ?>"></div>
              <div class="col-md-6"><label class="form-label">TikTok</label><input class="form-control" name="tiktok" value="<?php echo htmlspecialchars($settings['tiktok']??''); ?>"></div>
              <div class="col-md-6"><label class="form-label">Dirección</label><input class="form-control" name="address" value="<?php echo htmlspecialchars($settings['address']??''); ?>"></div>
              <div class="col-md-6"><label class="form-label">Yape</label><input class="form-control" name="yape" value="<?php echo htmlspecialchars($settings['yape']??''); ?>"></div>
              <div class="col-md-6"><label class="form-label">Plin</label><input class="form-control" name="plin" value="<?php echo htmlspecialchars($settings['plin']??''); ?>"></div>
            </div>
            <div class="mt-3">
              <button class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card bg-body-tertiary">
        <div class="card-body">
          <h2 id="mensajes" class="h5">Mensajes recientes</h2>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead><tr><th>Fecha</th><th>Nombre</th><th>Teléfono</th><th>Email</th><th>Mensaje</th></tr></thead>
              <tbody>
                <?php foreach($pdo->query("SELECT * FROM messages ORDER BY id DESC LIMIT 50") as $m): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($m['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($m['name']); ?></td>
                    <td><?php echo htmlspecialchars($m['phone']); ?></td>
                    <td><?php echo htmlspecialchars($m['email']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($m['message'])); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card bg-body-tertiary">
        <div class="card-body">
          <h2 id="servicios" class="h5">Servicios</h2>
          <form class="row g-2" method="post">
            <input type="hidden" name="action" value="save_service">
            <input type="hidden" name="id" value="">
            <div class="col-md-3"><input class="form-control" name="title" placeholder="Título" required></div>
            <div class="col-md-6"><input class="form-control" name="description" placeholder="Descripción" required></div>
            <div class="col-md-2"><input class="form-control" name="price" placeholder="Precio (opcional)" type="number" step="0.01"></div>
            <div class="col-md-1"><button class="btn btn-primary w-100">Agregar</button></div>
          </form>
          <div class="table-responsive mt-3">
            <table class="table table-sm">
              <thead><tr><th>ID</th><th>Título</th><th>Precio</th><th></th></tr></thead>
              <tbody>
                <?php foreach($services as $s): ?>
                  <tr>
                    <td><?php echo $s['id']; ?></td>
                    <td><?php echo htmlspecialchars($s['title']); ?></td>
                    <td><?php echo is_null($s['price'])?'—':'S/ '.number_format($s['price'],2); ?></td>
                    <td><a class="btn btn-outline-danger btn-sm" href="?del_service=<?php echo $s['id']; ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card bg-body-tertiary">
        <div class="card-body">
          <h2 id="portafolio" class="h5">Portafolio</h2>
          <form class="row g-2" method="post">
            <input type="hidden" name="action" value="add_portfolio">
            <div class="col-md-2">
              <select class="form-select" name="type">
                <option value="image">Imagen</option>
                <option value="video">Video</option>
              </select>
            </div>
            <div class="col-md-7"><input class="form-control" name="file_path" placeholder="Ruta (ej: assets/img/1.jpg ó assets/video/1.mp4)" required></div>
            <div class="col-md-2"><input class="form-control" name="caption" placeholder="Leyenda"></div>
            <div class="col-md-1"><button class="btn btn-primary w-100">Agregar</button></div>
          </form>
          <div class="table-responsive mt-3">
            <table class="table table-sm">
              <thead><tr><th>ID</th><th>Tipo</th><th>Archivo</th><th>Acciones</th></tr></thead>
              <tbody>
                <?php foreach($portfolio as $it): ?>
                  <tr>
                    <td><?php echo $it['id']; ?></td>
                    <td><?php echo $it['type']; ?></td>
                    <td><?php echo htmlspecialchars($it['file_path']); ?></td>
                    <td><a class="btn btn-outline-danger btn-sm" href="?del_item=<?php echo $it['id']; ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</body></html>
