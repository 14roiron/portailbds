# portailbds
à faire pour les évènement : 

TODO

Evenement 

affichage du calendrier dans la branche aside avec un mini calendrier

affichage des évènements dans un calendrier 

placer le bouton "validation capitaine"

placer le bouton "validation user"


POUR L’INSTALLATION 

il persiste un bug dans le datepicker Bundle il faut patcher manuellement le fichier de form :
public function getName(){ return $this->getBlockPrefix();}

pour que ça marche avec 2.8
