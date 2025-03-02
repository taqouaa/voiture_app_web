<?php
session_start();
$conn = new mysqli("localhost", "root", "", "personnevoiture");
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$email = $_SESSION['email'];

$queryPersonne = "SELECT nom FROM personne WHERE email = '$email'";
$resultPersonne = $conn->query($queryPersonne);

if ($resultPersonne->num_rows > 0) {
    $person = $resultPersonne->fetch_assoc();
    $nom_personne = $person['nom'];

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
    <title>Liste de Voitures</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5; /* خلفية رمادية فاتحة */
            color: #333;
        }

        h2 {
            text-align: left;
            margin-left: 5%;
            color: #007bff;
            animation: fadeIn 1s ease-in-out;
        }

        table {
            width: 70%;
            margin: 20px 5%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transform: scale(0.9);
            animation: scaleUp 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes scaleUp {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: linear-gradient(to right, #007bff, #6ec6ff);
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        tr:hover {
            background: #d9edf7;
            transition: 0.3s ease-in-out;
        }

        td img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            transition: transform 0.3s ease-in-out;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        td img:hover {
            transform: scale(1.1);
        }

        td.photos-container {
            text-align: left; /* تم تحريك الصور إلى اليسار */
            padding-left: 15px;
        }

        .btn {
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5%;
            font-size: 16px;
            transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
            display: inline-block;
        }

        .btn:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <h2>Liste de Voitures avec Photo</h2>

    <table>
        <tr>
            <th>Matricule</th>
            <th>Type</th>
            <th>Photos</th>
        </tr>
        <?php if ($resultVoitures->num_rows > 0): ?>
            <?php while ($voiture = $resultVoitures->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $voiture['mat']; ?></td>
                    <td><?php echo $voiture['type']; ?></td>
                    <td class="photos-container">
                        <?php if (!empty($voiture['image'])): ?>
                            <img src="<?php echo $voiture['image']; ?>" alt="Photo de la voiture">
                        <?php else: ?>
                            <span style="color: #007bff;">Pas de photos</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Aucune voiture trouvée.</td>
            </tr>
        <?php endif; ?>
    </table>

    <button onclick="window.location.href='espace.php'" class="btn">Retour</button>

</body>
</html>






