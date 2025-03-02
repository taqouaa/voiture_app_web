<?php
session_start();
$conn = new mysqli("localhost", "root", "", "personnevoiture");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

 
    $query = "SELECT * FROM compte WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);
    
  

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header("Location: espace.php"); // التوجيه إلى espace.php بعد تسجيل الدخول
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Authentification</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
  <style>
    /* إعادة تعيين بعض الأنماط الأساسية */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Roboto', sans-serif;
      /* تدرج ألوان داكن مع تأثير معدني يناسب موقع سيارات */
      background: linear-gradient(135deg, #000428, #004e92);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      overflow: hidden;
    }
    
    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    
    .container {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      padding: 40px;
      width: 360px;
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      text-align: center;
      animation: fadeIn 1.5s ease-in-out;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    
    h2 {
      color: #f1f1f1;
      margin-bottom: 20px;
      font-weight: 500;
      font-size: 28px;
      letter-spacing: 1px;
    }
    
    input {
      width: 100%;
      padding: 12px 15px;
      margin: 15px 0;
      border: none;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      font-size: 16px;
      outline: none;
      transition: background 0.3s, box-shadow 0.3s;
    }
    
    input::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }
    
    input:focus {
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
    }
    
    button {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      border: none;
      border-radius: 8px;
      background: #e74c3c;
      color: #fff;
      font-size: 18px;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
      position: relative;
      overflow: hidden;
    }
    
    button:hover {
      background: #c0392b;
      transform: translateY(-2px);
    }
    
    button:active::after {
      content: "";
      position: absolute;
      background: rgba(255,255,255,0.4);
      width: 0;
      height: 0;
      border-radius: 50%;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      animation: ripple 0.8s ease-out;
    }
    
    @keyframes ripple {
      from { width: 0; height: 0; opacity: 1; }
      to { width: 300px; height: 300px; opacity: 0; }
    }
    
    .forgot-password {
      margin-top: 20px;
      font-size: 14px;
    }
    
    .forgot-password a {
      color: #e74c3c;
      text-decoration: none;
      transition: color 0.3s;
    }
    
    .forgot-password a:hover {
      color: #c0392b;
      text-decoration: underline;
    }
    
    .error {
      margin-top: 15px;
      font-size: 14px;
      color: #ff6b6b;
      animation: fadeIn 0.5s ease-in-out;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Se connecter</h2>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <button type="submit">Se connecter</button> <!-- تمت إزالة onclick -->
    </form>
    <div class="forgot-password">
      <a href="mtpsObl.php">Mot de passe oublié?</a>
    </div>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
  </div>
</body>
</html>

    
















