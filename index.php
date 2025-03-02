<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Voiture</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('ff.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #2c3e50;
            line-height: 1.6;
        }

        header {
            background: rgba(44, 62, 80, 0.8); /* أزرق غامق شفاف */
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
            text-align: center;
            flex: 1;
            color: #ecf0f1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        #logo-text {
            font-size: 2rem;
            font-weight: bold;
            color: #e74c3c; /* اللون الأحمر للشعار */
            font-family: 'Arial', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        nav {
            background: rgba(52, 73, 94, 0.8); /* أزرق رمادي */
            padding: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        nav a {
            color: #ecf0f1;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #3498db;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: rgba(236, 240, 241, 0.6); /* شفافية أكثر احترافية */
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .services, .professionals, .about, .faq, .contact {
            margin-bottom: 30px;
        }

        .services h2, .professionals h2, .about h2, .faq h2, .contact h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .services ul {
            list-style: none;
            padding: 0;
        }

        .services ul li {
            background: rgba(189, 195, 199, 0.6); /* شفافية أكثر احترافية */
            margin: 10px 0;
            padding: 10px;
            border-left: 5px solid #3498db;
            transition: transform 0.3s ease;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .services ul li:hover {
            transform: translateX(10px);
        }

        .professionals p, .about p, .faq p, .contact p {
            font-style: italic;
            color: #555;
        }

        .faq .question {
            font-weight: bold;
            color: #2c3e50;
            cursor: pointer;
            margin: 10px 0;
            transition: color 0.3s ease;
        }

        .faq .question:hover {
            color: #3498db;
        }

        .faq .answer {
            display: none;
            margin-left: 20px;
            color: #555;
        }

        .contact form {
            display: flex;
            flex-direction: column;
        }

        .contact form input, .contact form textarea {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.8);
        }

        .contact form button {
            padding: 10px;
            background: #3498db;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            color: #fff;
            font-weight: bold;
        }

        .contact form button:hover {
            background: #2980b9;
        }

        footer {
            background: rgba(44, 62, 80, 0.8); /* أزرق غامق شفاف */
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.3);
        }

        footer p {
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <header>
        <div id="logo-text">Auto</div>
        <h1>Gestion de Voiture</h1>
    </header>

    <nav>
        <a href="creer_compte.php">Créer un nouveau compte</a>
        <a href="connecter.php">Se connecter</a>
        <a href="#services">Nos Services</a>
        <a href="#professionals">Professionnels</a>
        <a href="#about">À propos</a>
        <a href="#faq">FAQ</a>
        <a href="#contact">Contact</a>
    </nav>

    <div class="container">
        <section class="services" id="services">
            <h2>Nos Services</h2>
            <p>Nous offrons des services de maintenance de voiture à distance, y compris des diagnostics, des conseils et des suivis réguliers.</p>
            <ul>
                <li>Diagnostics à distance</li>
                <li>Suivi de l'entretien</li>
                <li>Consultation avec des mécaniciens</li>
                <li>Assistance 24/7</li>
            </ul>
        </section>

        <section class="professionals" id="professionals">
            <h2>Professionnels de la Maintenance</h2>
            <p>Notre réseau de professionnels qualifiés est à votre disposition pour offrir des services de maintenance de voiture à distance.</p>
            <p><strong>Davier l’hésicocord</strong></p>
        </section>

        <section class="about" id="about">
            <h2>À propos de nous</h2>
            <p>Nous sommes une entreprise spécialisée dans la gestion et la maintenance des véhicules. Notre mission est de fournir des services de qualité pour assurer la longévité et la performance de votre voiture.</p>
        </section>

        <section class="faq" id="faq">
            <h2>FAQ</h2>
            <div class="question" onclick="toggleAnswer(1)">Comment puis-je créer un compte ?</div>
            <div class="answer" id="answer1">Cliquez sur "Créer un nouveau compte" et suivez les instructions.</div>
            <div class="question" onclick="toggleAnswer(2)">Quels services proposez-vous ?</div>
            <div class="answer" id="answer2">Nous proposons des diagnostics à distance, un suivi de l'entretien, et des consultations avec des mécaniciens.</div>
            <div class="question" onclick="toggleAnswer(3)">Comment puis-je contacter un professionnel ?</div>
            <div class="answer" id="answer3">Vous pouvez contacter un professionnel via notre plateforme en ligne après vous être connecté.</div>
        </section>

        <section class="contact" id="contact">
            <h2>Contactez-nous</h2>
            <form>
                <input type="text" placeholder="Votre nom" required>
                <input type="email" placeholder="Votre email" required>
                <textarea placeholder="Votre message" rows="5" required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </section>
    </div>

    <footer>
        <p>&copy; 2023 Gestion de Voiture. Tous droits réservés.</p>
    </footer>

    <script>
        function toggleAnswer(id) {
            const answer = document.getElementById(`answer${id}`);
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>