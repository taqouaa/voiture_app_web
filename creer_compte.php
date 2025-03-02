<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "personnevoiture");
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Démarrage de la session
session_start();

// Variables pour les messages
$error = "";
$success = "";

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $prenom  = $_POST['prenom'];
    $nom     = $_POST['nom'];
    $email   = $_POST['email'];
    $tele    = $_POST['tele'];
    $adresse = $_POST['adresse'];
    $mdp     = $_POST['password'];

    // Vérification que tous les champs sont remplis
    if (empty($prenom) || empty($nom) || empty($email) || empty($tele) || empty($adresse) || empty($mdp)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        // Vérification si l'email est déjà utilisé
        $check = $conn->prepare("SELECT email FROM compte WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Cet email est déjà utilisé.";
        } else {
            // Ajout des données dans la table "compte"
            $stmt1 = $conn->prepare("INSERT INTO compte (email, password) VALUES (?, ?)");
            $stmt1->bind_param("ss", $email, $mdp);
            $stmt1->execute();

            // Ajout des données dans la table "personne"
            $stmt2 = $conn->prepare("INSERT INTO personne (nom, prenom, adresse, tele, email) VALUES (?, ?, ?, ?, ?)");
            $stmt2->bind_param("sssss", $nom, $prenom, $adresse, $tele, $email);
            $stmt2->execute();

            // Affichage d'un message de succès
            $success = "Compte créé avec succès ! <a href='connecter.php'> </a>";

            // Sauvegarde de l'email dans la session
            $_SESSION['email'] = $email;
        }
        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Créer un nouvel compte</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
  <style>
    /* Réinitialisation des styles de base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Roboto', sans-serif;
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
      width: 600px;
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      animation: fadeIn 1.5s ease-in-out;
      text-align: center;
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
      text-align: center;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .form-group {
      display: flex;
      gap: 20px;
    }
    .form-group .row {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .row label {
      color: #f1f1f1;
      margin-bottom: 5px;
      font-size: 14px;
      text-align: left;
    }
    input {
      width: 100%;
      padding: 12px 15px;
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
    .button {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
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
    .button:hover {
      background: #c0392b;
      transform: translateY(-2px);
    }
    .button:active::after {
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
    .button-connecter {
      width: auto;
      padding: 10px 20px;
      margin-top: 15px;
      border: none;
      border-radius: 8px;
      background: #2ecc71;
      color: #fff;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
      position: relative;
      overflow: hidden;
      display: inline-block;
      text-decoration: none;
    }
    .button-connecter:hover {
      background: #27ae60;
      transform: translateY(-2px);
    }
    .button-connecter:active::after {
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
    .msg {
      margin-top: 15px;
      font-size: 14px;
      text-align: center;
    }
    .error {
      color: #ff6b6b;
      animation: fadeIn 0.5s ease-in-out;
    }
    .success {
      color: #2ecc71;
      animation: fadeIn 0.5s ease-in-out;
    }
    a {
      text-decoration: none;
    }
  </style>
</head>
<body>
    <div class="container">
        <h2>Créer un nouvel compte</h2>
        <?php if (!empty($error)): ?>
            <div class="msg error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="msg success"><?php echo $success; ?></div>
            <a href="connecter.php" class="button-connecter">Se connecter</a>
        <?php else: ?>
            <form method="POST">
                <!-- Première ligne : Prénom et Nom -->
                <div class="form-group">
                    <div class="row">
                        <label for="prenom">Prénom :</label>
                        <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" required>
                    </div>
                    <div class="row">
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom" id="nom" placeholder="Votre nom" required>
                    </div>
                </div>
                <!-- Deuxième ligne : E-mail et Téléphone -->
                <div class="form-group">
                    <div class="row">
                        <label for="email">E-mail :</label>
                        <input type="email" name="email" id="email" placeholder="exemple@domaine.com" required>
                    </div>
                    <div class="row">
                        <label for="tele">Téléphone :</label>
                        <input type="text" name="tele" id="tele" placeholder="xxXXXXXXXX" required>
                    </div>
                </div>
                <!-- Troisième ligne : Adresse et Mot de passe -->
                <div class="form-group">
                    <div class="row">
                        <label for="adresse">Adresse :</label>
                        <input type="text" name="adresse" id="adresse" placeholder="Votre adresse" required>
                    </div>
                    <div class="row">
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" id="password" placeholder="********" required>
                    </div>
                </div>
                <button type="submit" class="button">Créer</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>