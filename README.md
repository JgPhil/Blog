# P5_blog
Project 5 Openclassrooms - Création d'un blog professionnel en PHP sans framework <br>

<b>Installation</b><br>

1.Installez Wampserver.<br>
Page de téléchargement - <http://wampserver.aviatechno.net/?lang=fr> <br>
2. Une fois Wampserver installé, cliquez sur l'icone "W" Cliquez sur "Vos virtuals hosts -> Gestion VirtualHosts".<br>
3. Créez un nouveau virtualhost nommez-le blog et le chemin sera celui-ci: c:/wamp64/www/blog/blog (tout en minuscules !important).<br>
4. Allez dans le dossier c:/wamp64/www/blog et initialisez le dossier avec git  <br>
5. Clonez ce repo  <https://github.com/JgPhil/Blog.git> dans dans ce dossier<br>
6. Cliquez à nouveau sur l'icone "W" et choisissez PHPMyAdmin. Identifiant: root, password: "vide"<br>
7. Créez une nouvelle base de donnée et nommez-la "blog".  <br>
8. importez-y la base de donnée grâce au fichier blog.sql qui se trouve à la racine du repo. <br>
9. Installez Composer . Choississez la méthode adaptée à votre système d'exploitation <https://getcomposer.org/download/><br>
10. Générez le fichier autoload avec cette commande: composer.phar dump-autoload. Le fichier composer.json se trouve dans le repo.<br>
11.L'application devrait fonctionner parfaitement.<br>
