# portailbds
#TODO (en vrac):

- integrer assetics pour accelerer le mod prod
- enlever le sport du coreBundle et lui creer un bundle à lui pour des problemes de sémentique
- gestion des evenements repetitif (comme les entraienments par exemple)
- message perso pour les utilisateur (1er pas vers les mails)
- revoir l'emplacement des images 
- personaliser bootstrap
- securité du site 
- mettre des glyphicones un peu partout 
- statistiques de l'équipe (qui vient quand)
- resultats sportifs
- gestionnaire admin pertinent
- fixture bundle (pour partager la bdd)
- utiliser la V4 de bootstrap 
- passer à symphony3
- Ajax du mini calendrier
- gestion de la "validation user"
- mettre en place des testers
- pour la selection des sports précocher les sports déjà sélectionnés (faire pareil pour le delete)


#POUR L’INSTALLATION 

il persiste un bug dans le datepicker Bundle il faut patcher manuellement le fichier de form :
public function getName(){ return $this->getBlockPrefix();}

pour que ça marche avec 2.8


