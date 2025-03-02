<?php
session_start();
$conn = new mysqli("localhost", "root", "", "personnevoiture");
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$email = $_SESSION['email'];

// Récupérer le nom de la personne associée à l'email
$queryPersonne = "SELECT nom FROM personne WHERE email = '$email'";
$resultPersonne = $conn->query($queryPersonne);

if ($resultPersonne->num_rows > 0) {
    $person = $resultPersonne->fetch_assoc();
    $nom_personne = $person['nom'];

    // Récupérer les voitures associées à cette personne
    $queryVoitures = "SELECT * FROM voiture WHERE idp = '$nom_personne'";
    $resultVoitures = $conn->query($queryVoitures);
} else {
    die("Aucune personne trouvée avec cet email : $email");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Voitures</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            padding: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: 600;
            animation: slideDown 0.7s ease-in-out;
        }

        .table-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
            text-transform: uppercase;
            font-weight: 500;
        }

        tr {
            transition: background-color 0.3s ease-in-out;
            opacity: 0;
            transform: translateY(10px);
            animation: fadeRow 0.7s ease-in-out forwards;
        }

        tr:nth-child(odd) {
            animation-delay: 0.1s;
        }

        tr:nth-child(even) {
            animation-delay: 0.2s;
        }

        tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        .btn {
            background: #007bff;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, background 0.3s ease-in-out;
        }

        .btn:hover {
            background: #0056b3;
            transform: scale(1.1);
        }

        .btn-retour {
            display: block;
            width: 150px;
            margin: 20px auto;
            background: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s ease-in-out;
        }

        .btn-retour:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeRow {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <h2>Liste des voitures de vous : <?php echo htmlspecialchars($nom_personne); ?></h2>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Type</th>
                    <th>Couleur</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultVoitures->num_rows > 0): ?>
                    <?php while ($voiture = $resultVoitures->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($voiture['mat']); ?></td>
                            <td><?php echo htmlspecialchars($voiture['type']); ?></td>
                            <td><?php echo htmlspecialchars($voiture['couleur']); ?></td>
                            <td>
                                <button class="btn" onclick="location.href='modifv.php?id=<?php echo urlencode($voiture['mat']); ?>'">Modifier</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center; color:gray;">Aucune voiture trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="espace.php" class="btn-retour">Retour</a>

</body>
</html>
