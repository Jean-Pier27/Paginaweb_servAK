<?php
require_once __DIR__ . '/../db.php';
session_start();
$pdo = db();
$count = (int)$pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
$setup_mode = ($count === 0);
$error = null;

if ($setup_mode && $_SERVER['REQUEST_METHOD']==='POST') {
  $u = $_POST['username'] ?? '';
  $p = $_POST['password'] ?? '';
  if ($u && $p) {
    $hash = password_hash($p, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
    $stmt->execute([$u, $hash]);
    $_SESSION['admin']= $u;
    header("Location: dashboard.php"); exit;
  } else { $error = "Completa usuario y contraseña"; }
}

if (!$setup_mode && $_SERVER['REQUEST_METHOD']==='POST') {
  $stmt = $pdo->prepare("SELECT * FROM admins WHERE username=? LIMIT 1");
  $stmt->execute([$_POST['username'] ?? '']);
  $user = $stmt->fetch();
  if ($user && password_verify($_POST['password'] ?? '', $user['password_hash'])) {
    $_SESSION['admin']= $user['username'];
    header("Location: dashboard.php"); exit;
  } else { $error = "Usuario o contraseña incorrectos"; }
}
?>
<!DOCTYPE html>
<html lang="es"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $setup_mode?'Configurar administrador':'Iniciar sesión'; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-dark text-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm bg-body-tertiary">
        <div class="card-body">
          <h1 class="h4 mb-3"><?php echo $setup_mode?'Configurar administrador':'Panel — Ingresar'; ?></h1>
          <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
          <form method="post">
            <div class="mb-3">
              <label class="form-label">Usuario</label>
              <input class="form-control" name="username" required value="<?php echo $setup_mode ? 'ServiceAK' : '';?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="password" required value="<?php echo $setup_mode ? 'ProyectoFinal' : '';?>">
              <?php if ($setup_mode): ?><div class="form-text">Se creará este usuario la primera vez. Luego podrás cambiarlo.</div><?php endif; ?>
            </div>
            <button class="btn btn-primary w-100"><?php echo $setup_mode?'Crear y entrar':'Entrar'; ?></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body></html>
