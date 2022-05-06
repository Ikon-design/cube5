On va le dégommer ce cube

# cube5


Débug php: 

* Un message d’erreur s’affiche quand on ne poste pas une photo dans une annonce (les champs devaient être tous requis) 
* Quand un utilisateur s’enregistre il n’est pas connecté tout de suite après 
* J’ai l’impression que le bouton “se souvenir de moi” ne fonctionne pas, pouvez-vous vérifier ? 
* Il était prévu que nous ayons un formulaire de contact sur la page du produit mais aujourd’hui c’est la boite mail qui s’ouvre
* Egalement il était prévu que j’aie sur mon compte videgrenierenligne un espace ou je peux voir les statistiques du site mais aujourd’hui je n’ai rien quand je me connecte avec mon adresse mail. 
* D'autre à trouver

Ajout: 

* Favicon


Taches:  <br>
Créer un repository pour y mettre le code de l’application. <br>
Mettre en place (utiliser) un système de gestion des issues et répartir ces taches entre les membres des votre équipe <br>
Travailler en mode «GitFlow»Concevoir un environnement de développement basé sur Docker(serveur Web + Base de données) <br>
Apporter les corrections au site Internet <br>
Créer les test unitaires de l’application <br>
Utiliser le merge request pour pousser le code de la branche «stage» (ou recette) versla branche «master» (ou main) <br>
Concevoir un environnement de pré-productionbasé sur Docker en respectant l’architecture suivante: <br>
	o Un Container pour la base de données en persistente <br>
	o Un Container pour le service Web avec récupération du dépôt GIT branche «Stage» (ou recette) <br>
Concevoir un environnement de production basé sur Docker en respectant l’architecture suivante: <br>
	oUn Container pour la base de données en persistenteoUn Container pour le service Web avec le code de la branche «master»(ou main)déjà présent dans l’image Docker <br>
Utiliser un système de génération documentaire pour le code API <br>
