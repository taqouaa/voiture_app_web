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
} else {
    die("Aucune personne trouvée avec cet email : $email");
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mat = $_POST['mat'];
    $type = $_POST['type'];
    $couleur = $_POST['couleur'];
    // CODE POUR L'AJOUTE DE L'IMAGE
    // Vérifier si une image a été téléchargée
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/"; // Dossier où enregistrer les images
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Vérification du format de l'image
        $extensions_autorisees = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $extensions_autorisees)) {
            die("Erreur : Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.");
        }

        // Déplacer le fichier vers le dossier uploads
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            die("Erreur lors du téléchargement de l'image.");
        }
    } else {
        $target_file = NULL; // Si aucune image n'est téléchargée
    }

    // Vérifier si la voiture existe déjà
    $checkCarQuery = "SELECT * FROM voiture WHERE mat = '$mat'";
    $resultCheck = $conn->query($checkCarQuery);

    if ($resultCheck->num_rows > 0) {
        echo "Erreur : Une voiture avec cette matricule existe déjà.";
    } else {
        // Insérer la voiture avec l'image
        $queryInsert = "INSERT INTO voiture (mat, type, couleur, idp, image) VALUES ('$mat', '$type', '$couleur', '$nom_personne', '$target_file')";
        if ($conn->query($queryInsert) === TRUE) {
            echo "Voiture ajoutée avec succès!";
            header("Location: afficher_voiture_photo.php"); // Redirection vers la liste des voitures
            exit();
        } else {
            echo "Erreur lors de l'ajout : " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Voiture</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f0f0; /* رمادي فاتح */
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff; /* أبيض */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* تظليل أقوى */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .container:hover {
            transform: translateY(-5px); /* حركة خفيفة عند التمرير */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3); /* تظليل أقوى عند التمرير */
        }
        h2 {
            color: #343a40; /* رمادي داكن */
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* تظليل للنص */
        }
        .form-label {
            font-weight: bold;
            color: #495057; /* رمادي داكن */
        }
        .form-control {
            border: 1px solid #ced4da; /* رمادي فاتح */
            border-radius: 8px;
            padding: 10px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1); /* تظليل داخلي */
        }
        .form-control:focus {
            border-color: #007bff; /* أزرق */
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5); /* تظليل عند التركيز */
        }
        .btn-primary {
            background-color: #007bff; /* أزرق */
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* تظليل للزر */
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* أزرق داكن */
            transform: translateY(-2px); /* حركة خفيفة */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* تظليل أقوى */
        }
        .animate__animated {
            animation-duration: 1s;
        }
    </style>
</head>
<body>
    <div class="container animate__animated animate__fadeIn">
        <h2 class="text-center mb-4">Ajouter une voiture pour vous <?php echo $nom_personne; ?></h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Matricule:</label>
                <input type="text" name="mat" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Type:</label>
                <input type="text" name="type" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Couleur:</label>
                <input type="text" name="couleur" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image:</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary animate__animated animate__pulse">Ajouter</button>
            </div>
        </form>
    </div>


</body>
</html>


