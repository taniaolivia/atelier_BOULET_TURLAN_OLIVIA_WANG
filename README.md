# atelier_BOULET_TURLAN_OLIVIA_WANG

<h1>Équipes du groupe</h1>
<ol>
<li>Clément BOULET/ LP2</li>
<li>Guillaume TURLAN/ LP2</li>
<li>Tania OLIVIA/ LP2</li>
<li>Ziyi WANG/ LP2</li>
</ol>


<h1>Consignes d'installation</h1>

<ol>
  <li>Arrêtez XAMPP/WAMP/LAMP/MAMP, si vous avez déjà lancé</li>
  <li>Vous pouvez cloner ssh dans n'importe quel répertoire de votre choix, mais pas dans le répertoire XAMPP/LAMP/WAMP/MAMP</li>
  <li>Lancez le service docker</li>
  <li>Sous répertoire de atelier_BOULET_TURLAN_OLIVIA_WANG, tapez la commande <code>docker-compose up --build</code> sur terminal</li>
  
  <li>
    Connectez sur phpmyadmin <code>http://localhost:8081</code> avec des variables correspondant aux paramètres suivants :<br>
    <ul>Utilisateur: btow</ul>
    <ul>Mot de passe: btow</ul>
  </li>
  
  <li>Sous répertoire de atelier_BOULET_TURLAN_OLIVIA_WANG, tapez le commande <code>docker-compose exec php bash</code> et
  <code>vendor/bin/doctrine orm:schema-tool:create</code> pour générer des tableau de base.</li>

  <li>Mettre en place le script de la base de donnée <code>(scriptBash.sql)</code>
          sur phpmyadmin <code>http://localhost:8081</code></li>
  <li>Lancez l'application sur navigateur <code>http://localhost:8080</code></li>
  <li>Vous pouvez maitenant profiter de l'application</li>
</ol>

<h1>Lien utiles</h1>
<address>
    <a href="https://github.com/taniaolivia/atelier_BOULET_TURLAN_OLIVIA_WANG">Lien Github</a>
    <a href="https://trello.com/invite/b/IP8662es/36311ddee1c603b49997901532cecf96/atelier">Lien Trello</a>
</address>


