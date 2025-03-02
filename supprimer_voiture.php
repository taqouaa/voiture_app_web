<?php
session_start();
$conn = new mysqli("localhost", "root", "", "personnevoiture");
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$email = $_SESSION['email'];

// Récupérer les informations de la personne
$queryPersonne = "SELECT nom FROM personne WHERE email = '$email'";
$resultPersonne = $conn->query($queryPersonne);

if ($resultPersonne->num_rows > 0) {
    $person = $resultPersonne->fetch_assoc();
    $nom_personne = $person['nom'];

    // Récupérer les voitures de la personne
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
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: 600;
        }

        .table-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
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

        tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        .btn {
            background: #dc3545;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: 0.3s ease-in-out;
        }

        .btn:hover {
            background: #b02a37;
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
            transition: 0.3s;
        }

        .btn-retour:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Liste des voitures de vous : <?php echo $nom_personne; ?></h2>
    
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
                            <td><?php echo $voiture['mat']; ?></td>
                            <td><?php echo $voiture['type']; ?></td>
                            <td><?php echo $voiture['couleur']; ?></td>
                            <td>
                                <a href="suppv.php?id=<?php echo $voiture['mat']; ?>" class="btn">Supprimer</a>
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



