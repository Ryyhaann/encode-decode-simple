<?php
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function die_back($msg){
  echo "<!doctype html><html><head><meta charset='utf-8'><title>Error</title></head><body style='background:#0b1220;color:#fff;font-family:Poppins;padding:40px;text-align:center;'><h2 style='color:#ffb4b4'>$msg</h2><p><a href='index.php' style='color:#06b6d4'>Kembali</a></p></body></html>";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: index.php');
  exit;
}

$upload_dir = __DIR__ . '/uploads/';
if (!is_dir($upload_dir)) {
  if (!mkdir($upload_dir, 0777, true) && !is_dir($upload_dir)) {
    die_back('Gagal membuat folder uploads (permission?).');
  }
}

$input_text = $_POST['input'] ?? '';
$action = $_POST['action'] ?? '';
$input = '';
$uploaded_path = '';
$uploaded_filename = '';

if (!empty($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
  $orig_name = basename($_FILES['file']['name']);
  $safe_name = preg_replace('/[^A-Za-z0-9._-]/', '_', $orig_name);
  $unique = uniqid('up_', true) . '_' . $safe_name;
  $target = $upload_dir . $unique;

  if (!move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
    die_back('Gagal menyimpan file upload.');
  }

  $uploaded_filename = $safe_name;
  $uploaded_path = $target;
  $input = file_get_contents($uploaded_path);
} else {
  $input = trim($input_text);
}

if ($input === '') {
  die_back('Tidak ada input teks atau file yang dikirim.');
}

$result = '';
$error = '';
try {
  switch ($action) {
    case 'base64_encode': $result = base64_encode($input); break;
    case 'base64_decode':
      $decoded = base64_decode($input, true);
      if ($decoded === false) $error = 'Input bukan Base64 yang valid.'; else $result = $decoded;
      break;
    case 'url_encode': $result = urlencode($input); break;
    case 'url_decode': $result = urldecode($input); break;
    case 'html_entities_encode': $result = htmlentities($input, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); break;
    case 'html_entities_decode': $result = html_entity_decode($input, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); break;
    case 'rot13': $result = str_rot13($input); break;
    case 'md5': $result = md5($input); break;
    case 'sha1': $result = sha1($input); break;
    case 'hex_encode': $result = bin2hex($input); break;
    case 'hex_decode':
      if (preg_match('/^[0-9a-fA-F]+$/', $input) && strlen($input) % 2 === 0) {
        $decoded = hex2bin($input);
        if ($decoded === false) $error = 'Input Hex tidak valid.'; else $result = $decoded;
      } else {
        $error = 'Input Hex tidak valid (harus hanya 0-9a-f dan panjang genap).';
      }
      break;
    default: $error = 'Operasi tidak valid.';
  }
} catch (Throwable $e) {
  $error = 'Error: ' . $e->getMessage();
}

if ($error) die_back($error);

$time = date('Ymd_His');
$label = $uploaded_filename ?: 'text';
$result_name = 'hasil_' . pathinfo($label, PATHINFO_FILENAME) . '_' . $action . '_' . $time . '.txt';
$result_path = $upload_dir . $result_name;
file_put_contents($result_path, $result);
$download_url = 'uploads/' . basename($result_path);
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Hasil Encode / Decode</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<style>
  :root{--bg:#0b1220;--panel:#10182b;--accent:#06b6d4}
  body{font-family:'Poppins',sans-serif;background:var(--bg);color:#fff;padding:20px;display:flex;justify-content:center;min-height:100vh;margin:0}
  .wrap{max-width:900px;width:100%;background:var(--panel);padding:18px;border-radius:12px;box-shadow:0 8px 30px rgba(0,0,0,0.5)}
  h2{margin-top:0}
  pre{background:rgba(255,255,255,0.05);padding:12px;border-radius:8px;white-space:pre-wrap;word-wrap:break-word;max-height:420px;overflow:auto}
  .btns{margin-top:14px;display:flex;gap:10px;flex-wrap:wrap}
  button,a{padding:10px 14px;border-radius:8px;text-decoration:none;font-weight:700;cursor:pointer;border:none}
  .copy{background:var(--accent);color:#002}
  .download{background:#334155;color:#fff}
  .back{background:#222;color:#ccc}
  .note{margin-top:10px;color:#94a3b8}
  @media (max-width:480px){
    body{padding:10px}
    .wrap{padding:12px}
    pre{font-size:13px}
  }
</style>
</head>
<body>
<div class="wrap">
  <h2>Hasil Operasi: <?= h($action) ?></h2>

  <label style="color:#94a3b8">Hasil</label>
  <pre id="result"><?= h($result) ?></pre>

  <div class="btns">
    <button class="copy" onclick="copyText()">Salin Hasil</button>
    <a class="download" href="<?= h($download_url) ?>" download="<?= h(basename($result_path)) ?>">Download Hasil</a>
    <?php if ($uploaded_path): ?>
      <a class="back" href="<?= h('uploads/' . basename($uploaded_path)) ?>" download>Download File Asli</a>
    <?php endif; ?>
    <a class="back" href="index.php">Kembali</a>
  </div>

  <p class="note">File tersimpan di folder <code>uploads/</code>. Hapus secara manual jika tidak diperlukan.</p>
</div>

<script>
function copyText(){
  const pre=document.getElementById('result');
  const text=pre?pre.innerText:'';
  navigator.clipboard.writeText(text).then(()=>{
    alert('✅ Hasil disalin ke clipboard!');
  }).catch(()=>{
    alert('❌ Gagal menyalin ke clipboard.');
  });
}
</script>
</body>
</html>
