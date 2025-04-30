
### 📘 README — Mode d'emploi

#### 🇫🇷 Français

---

### 📋 Objectif

Ce script PHP vous permet de contourner la limitation des tâches planifiées (cron) d'OVH en appelant une URL automatiquement et en sauvegardant le résultat dans un fichier `.log`.

---

### ⚙️ Comment l’utiliser

1. **Ouvrez le fichier PHP** ```launch-cron.php``` dans un éditeur de texte.
2. **Remplacez** la ligne :
   ```php
   $url = "Place here your URL to call";
   ```
   par l'adresse de la page ou script que vous souhaitez exécuter automatiquement.

   Exemple :
   ```php
   $url = "https://URL_DOLIBARR/htdocs/public/cron/cron_run_jobs_by_url.php?securitykey=SECURITY_KEY&userlogin=USERLOGIN&id=ID_TASK";
   ```

3. **Téléversez** ce fichier PHP sur votre hébergement OVH. De préférence dans un dossier privé (non accéssible publiquement).
4. **renommez** si nécessaire ce fichier avec un nom qui vous permet d'identifier l'url qui sera appelée.
5. **Créez une tâche planifiée (cron)** dans votre espace client OVH qui appelle ce fichier.

---

### 🧪 Résultat

- Si tout fonctionne, le script crée un fichier `nom_du_script.log` avec le contenu de la page appelée.
- En cas d’erreur, un message s'affiche : `Error on url call`.

---

### 📌 Astuce

Vous pouvez consulter le fichier `.log` pour vérifier si votre tâche s’est bien exécutée.
