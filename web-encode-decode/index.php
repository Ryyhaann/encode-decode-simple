<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Encode / Decode Tools</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family:'Poppins',sans-serif;
      background:#0b1220;
      color:#fff;
      display:flex;
      justify-content:center;
      align-items:flex-start;
      min-height:100vh;
      padding:30px;
      margin:0;
    }
    .container {
      background:#10182b;
      border-radius:12px;
      padding:20px;
      max-width:800px;
      width:100%;
      box-shadow:0 0 30px rgba(0,0,0,0.3);
    }
    h1{text-align:center;margin-bottom:20px;}
    textarea,input[type=file],select{
      width:100%;
      padding:10px;
      margin-top:10px;
      border-radius:8px;
      border:1px solid #333;
      background:rgba(255,255,255,0.05);
      color:#fff;
      font-size:14px;
    }
    select {
      background-color:#18233b;
      color:#fff;
      cursor:pointer;
    }
    select option {
      background-color:#18233b;
      color:#fff;
    }
    select option:hover {
      background-color:#06b6d4;
      color:#000;
    }
    label {
      display:block;
      margin-top:15px;
      font-weight:500;
    }
    .btns {
      margin-top:20px;
      display:flex;
      gap:10px;
      flex-wrap:wrap;
    }
    button {
      padding:10px 16px;
      border:none;
      border-radius:8px;
      cursor:pointer;
      font-weight:bold;
      transition:0.3s;
    }
    .btn-primary{background:#06b6d4;color:#000;}
    .btn-primary:hover{background:#0891b2;}
    .btn-secondary{background:transparent;color:#ccc;border:1px solid #444;}
    .btn-secondary:hover{background:#222;}
    @media(max-width:480px){
      body{padding:15px;}
      .container{padding:15px;}
      textarea{min-height:100px;}
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>🧩 Tools Encode / Decode </h1>

    <form method="post" action="process.php" enctype="multipart/form-data" id="encodeForm">
      <label>Input Teks (opsional)</label>
      <textarea name="input" placeholder="Masukkan teks di sini..."></textarea>

      <label>Pilih File (opsional)</label>
      <input type="file" name="file">

      <label>Pilih Operasi</label>
      <select name="action" required>
        <option value="" disabled selected>-- Pilih Operasi --</option>
        <option value="base64_encode">Base64 Encode</option>
        <option value="base64_decode">Base64 Decode</option>
        <option value="url_encode">URL Encode</option>
        <option value="url_decode">URL Decode</option>
        <option value="html_entities_encode">HTML Entities Encode</option>
        <option value="html_entities_decode">HTML Entities Decode</option>
        <option value="rot13">ROT13</option>
        <option value="md5">MD5 Hash (one-way)</option>
        <option value="sha1">SHA1 Hash (one-way)</option>
        <option value="hex_encode">Hex Encode</option>
        <option value="hex_decode">Hex Decode</option>
      </select>

      <div class="btns">
        <button type="submit" class="btn-primary">Proses</button>
        <button type="button" class="btn-secondary" onclick="document.getElementById('encodeForm').reset()">Reset</button>
      </div>
    </form>
  </div>
</body>
</html>
