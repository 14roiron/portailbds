# portailbds
#TODO (en vrac):

- integrer assetics pour accelerer le mod prod
- gestion des evenements repetitif (comme les entraienments par exemple)
- message perso pour les utilisateur (1er pas vers les mails)
- revoir l'emplacement des images 
- personaliser bootstrap
- securité du site 
- statistiques de l'équipe (qui vient quand)
- resultats sportifs
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

J’ai installer un nouveau bundle pour le chat (il n’y en a que 2 sur le net et aucun n’est vraiment maintenu. j’ai du faire beaucoup de motif pour qu’il fonctionne directement dans vendor (elles sont rertorier sur mon fork https://github.com/12rambau/ChatBundle)


