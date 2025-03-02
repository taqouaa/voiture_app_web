<?php
session_start();

// إذا لم يكن هناك بريد محفوظ في السيشن، نعيد التوجيه للصفحة السابقة
if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "personnevoiture");

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إذا تم إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        // تحديث كلمة المرور في قاعدة البيانات
        $stmt = $conn->prepare("UPDATE compte SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $_SESSION['reset_email']);
        $stmt->execute();

        // بعد التحديث، نحذف الإيميل من السيشن
        unset($_SESSION['reset_email']);

        // رسالة تأكيد
        $success = "Votre mot de passe a été réinitialisé avec succès. 
                    <a href='connecter.php' style='color: #fff; text-decoration: underline;'>Se connecter</a>";
    } else {
        $error = "Les mots de passe ne correspondent pas.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Réinitialiser le mot de passe</title>
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

    .error, .success {
      margin-top: 15px;
      font-size: 14px;
    }

    .error {
      color: #ff6b6b;
    }

    .success {
      color: #2ecc71;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Réinitialiser le mot de passe</h2>
    <?php if (isset($success)): ?>
      <p class="success"><?php echo $success; ?></p>
    <?php else: ?>
      <form method="POST">
        <input type="password" name="new_password" placeholder="Nouveau mot de passe" required />
        <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required />
        <button type="submit">Enregistrer</button>
      </form>
      <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</body>
</html>
