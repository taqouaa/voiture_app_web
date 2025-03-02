<?php
session_start();


$conn = new mysqli("localhost", "root", "", "personnevoiture");
$email = $_SESSION['email'];

// Requête pour récupérer les informations de la personne
$query = "SELECT * FROM personne WHERE email = '$email'";
$result = $conn->query($query);
$person = $result->fetch_assoc();
$_SESSION['nom'] = $person['nom'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Gestion de Voitures</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #1a1a1a, #2c2c2c);
            color: white;
            overflow: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #1e1e1e, #ff7700);
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s;
        }

        .sidebar:hover {
            transform: scale(1.02);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
            border-bottom: 2px solid white;
            padding-bottom: 10px;
            animation: fadeIn 1s ease-in-out;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: block;
            padding: 12px;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar ul li a:hover {
            background-color: rgba(255, 119, 0, 0.3);
            transform: translateX(5px);
        }

        .content {
            flex-grow: 1;
            padding: 50px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* تغيير هذه القيمة لتحريك المحتوى لأعلى */
            align-items: center;
            background: url('hh.JPG') no-repeat center center/cover;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            animation: slideIn 1.5s ease-in-out;
        }

        .content h1 {
            font-size: 42px; /* زيادة حجم الخط */
            margin-top: 20px; /* إضافة مسافة من الأعلى */
            animation: fadeIn 1.5s ease-in-out;
        }

        .content p {
            font-size: 24px; /* زيادة حجم الخط */
            margin-top: 10px; /* إضافة مسافة من الأعلى */
            animation: fadeIn 2s ease-in-out;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                text-align: center;
            }

            .sidebar ul li a {
                display: inline-block;
                width: 80%;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-100px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="ajouter_voiture.php"><i class="fas fa-car"></i>Ajouter une nouvelle voiture</a></li>
                <li><a href="afficher_voiture_photo.php"><i class="fas fa-list"></i>Consulter la liste des voitures avec photo</a></li>
                <li><a href="modifier_voiture.php"><i class="fas fa-edit"></i>Modifier une de mes voitures</a></li>
                <li><a href="supprimer_voiture.php"><i class="fas fa-trash"></i>Supprimer une de mes voitures</a></li>
            </ul>
        </aside>

        <main class="content">
            <h1>Bienvenue sur votre tableau de bord</h1>
            <p>Vous pouvez gérer vos voitures à partir du menu à gauche.</p>
        </main>
    </div>
</body>
</html>
