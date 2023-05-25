<!DOCTYPE html>
<head>
<meta charset="utf-8">
<link rel="icon" type="image/x-icon" href="mylogo.png">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
<meta property="og:title" content="My Citation | INSCCRIPTION" />
<meta property="og:description" content="Déchaine ta sagesse, My Citation." />
<meta property="og:image" content="#" />
</head>
<body>
 <nav class="navigation">
        <ul>
            <li><a href="citation.php">Accueil</a></li>
			<li><a href="apdn.html">A propos de nous</a></li>
			<li><a href="contact.php">Contact</a></li>

        </ul>
    </nav>
	
    <div class="centreur">
     <div class="titre"> <h1 class="title">Inscription</h1></div>
	 
		<p class="description">Inscrivez-vous pour accéder à l'entièreté du site!</p>
		
		<?php if (isset($error)) : ?>
      <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="in/inscription.php" style="text-align: center;">
      <div style="margin-bottom: 10px;">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required>
      </div>
      <div>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required>
      </div>
      <div>
        <button class="boutton" type="submit">S'inscrire</button>
		</div>
    </form>
	</div>
	<footer class="basdepage">
        <p class="bdptext">My Citation est OpenSource : <a href="https://github.com/" class="bdptext2"><i class="fa-brands fa-github"></i></a></p>
    </footer>
  </body>
</html>


