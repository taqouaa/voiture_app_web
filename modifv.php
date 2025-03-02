<?php
session_start();
$conn = new mysqli("localhost", "root", "", "personnevoiture");
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupération sécurisée de l'ID
$id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '';

$queryVoiture = "SELECT * FROM voiture WHERE mat = '$id'";
$resultVoiture = $conn->query($queryVoiture);

if ($resultVoiture->num_rows == 0) {
    die("Aucune voiture trouvée avec cet ID.");
}

$voiture = $resultVoiture->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $conn->real_escape_string($_POST['type']);
    $couleur = $conn->real_escape_string($_POST['couleur']);

    $updateQuery = "UPDATE voiture SET type = '$type', couleur = '$couleur' WHERE mat = '$id'";
    if ($conn->query($updateQuery) === TRUE) {
        header("Location: modifier_voiture.php"); // Redirection après modification
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Voiture</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            animation: fadeIn 0.7s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border 0.3s ease-in-out;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out, transform 0.2s;
            font-size: 1rem;
        }

        button:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .btn-cancel {
            background: #dc3545;
        }

        .btn-cancel:hover {
            background: #b02a37;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Modifier la Voiture</h2>
        <form method="POST">
            <label>Matricule:</label>
            <input type="text" value="<?php echo htmlspecialchars($voiture['mat']); ?>" disabled>

            <label for="type">Type:</label>
            <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($voiture['type']); ?>" required>

            <label for="couleur">Couleur:</label>
            <input type="text" id="couleur" name="couleur" value="<?php echo htmlspecialchars($voiture['couleur']); ?>" required>

            <div class="btn-container">
                <button type="submit">Sauvegarder</button>
                <button type="button" class="btn-cancel" onclick="window.location.href='modifier_voiture.php'">Annuler</button>
            </div>
        </form>
    </div>

</body>
</html>
