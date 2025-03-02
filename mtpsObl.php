<?php
session_start();

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "personnevoiture");

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إذا تم إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // التحقق من وجود البريد الإلكتروني في الجدول
    $stmt = $conn->prepare("SELECT * FROM compte WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // إذا وُجد البريد الإلكتروني
    if ($result->num_rows > 0) {
        // حفظ البريد في السيشن لاستخدامه في صفحة إعادة التعيين
        $_SESSION['reset_email'] = $email;
        header("Location: reset_password.php");
        exit();
    } else {
        $error = "Adresse email non trouvée dans notre base de données.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Mot de passe oublié</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(135deg, #000428, #004e92);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border-radius: 15px;
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.7);
      border: 1px solid rgba(255, 255, 255, 0.2);
      width: 360px;
      padding: 40px;
      text-align: center;
      color: #fff;
    }

    h2 {
      margin-bottom: 20px;
      font-size: 24px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      outline: none;
      font-size: 16px;
    }

    input::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    button {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      border: none;
      border-radius: 8px;
      background: #e74c3c;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    button:hover {
      background: #c0392b;
      transform: translateY(-2px);
    }

    .error {
      margin-top: 15px;
      color: #ff6b6b;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Mot de passe oublié</h2>
    <p>Entrez votre adresse email pour réinitialiser votre mot de passe</p>
    <form method="POST">
      <input type="email" name="email" placeholder="Votre email" required />
      <button type="submit">Réinitialiser</button>
    </form>
    <?php if (isset($error)): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
  </div>
</body>
</html>

