# portailbds
#TODO (en vrac):

- utiliser les paramConverter pour tous les controller
- integrer assetics pour accelerer le mod prod
- enlever le sport du coreBundle et lui creer un bundle à lui pour des problemes de sémentique
- gestion des evenements repetitif (comme les entraienments par exemple)
- affichage du profil d'un autre utilisateur
- alerte sur toutes les pages quand on réalise une action 
- message perso pour les utilisateur (1er pas vers les mails)
- revoir l'emplacement des images 
- personaliser bootstrap
- securité du site 
- mettre des glyphicones un peu partout 
- page participation (résumé pour chaque user)
- statistiques de l'équipe (qui vient quand)
- resultats sportifs
- ajouter le sexe de la personne
- gestionnaire admin pertinent
- fixture bundle (pour partager la bdd)
- utiliser la V4 de bootstrap 
- passer à symphony3
- affichage du calendrier dans la branche aside avec un mini calendrier
- gestion de la "validation capitaine"
- gestion de la "validation user"


#POUR L’INSTALLATION 

il persiste un bug dans le datepicker Bundle il faut patcher manuellement le fichier de form :
public function getName(){ return $this->getBlockPrefix();}

pour que ça marche avec 2.8
