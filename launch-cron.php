<?php
/*
 * Script compatible PHP 7.4 - 8.3
 */


/**
 * Configuration (modifiable)
 */
// 👉 Remplacez cette ligne par l'adresse (URL) de votre tâche ou page web à exécuter.
$url = "Place here your URL to call";
$writeLog = 1; // ecrire 1 si vous souhaitez un fichier de log, attention ce dernier portera le non du fichier suivi de .log ex ovh-cron-tool.log ce fichier devra être accéssible en écriture.
$checkSecurity = 1; // mettre 0 pour désactiver la vérification SSL. Dans certains cas si votre hébergement utilise un certificat SSL auto signé il peutêtre utile désactiver la vérification.


/**
 * Programme (éviter de modifier)
 */

// 🔄 On appelle la fonction ci-dessous pour récupérer le contenu de l'URL indiquée
callUrl($url, $writeLog, $checkSecurity);



// 🔧 Fonction technique qui appelle l'URL en utilisant la méthode CURL
function callUrl($url, int $writeLog=0,int $checkSecurity=1)
{
  	$ch = curl_init($url);
    // Options nécessaires pour récupérer correctement le contenu de la page
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Renvoyer la réponse sous forme de variable
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Suivre les redirections éventuelles

    if(empty($checkSecurity)) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Ne pas vérifier le certificat SSL (utile si l'URL utilise HTTPS)
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Idem pour l'hôte
    }


    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36');

    // Exécution de la requête
    $data = curl_exec($ch);

    // Fermeture de la session CURL
    curl_close($ch);

    if ($data === false) {
        // 🔴 Message d'erreur si la page n'a pas pu être appelée
        echo 'Error on url call';
        return false;
    }

    // ✅ Si on a bien reçu un contenu (la page a répondu correctement)
    if ($writeLog) {
        // 📁 On crée un fichier de log pour sauvegarder le résultat de l'appel
        // Le nom du fichier est le même que celui du script, avec l'extension .log
        $file = __DIR__ . '/' . basename(__FILE__ , ".php") . '.log';
        // ✍️ On écrit le contenu reçu dans ce fichier (cela remplace le précédent log)
        file_put_contents($file, $data);
    }
}
