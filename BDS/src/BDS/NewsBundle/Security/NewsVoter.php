<?php

namespace BDS\NewsBundle\Security;
 
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use BDS\UserBundle\Entity\Membre;
use BDS\UserBundle\Entity\User;
use BDS\CoreBundle\Entity\Sport;
use BDS\NewsBundle\Entity\News;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class NewsVoter extends Voter
{
    const VIEW = 'ROLE_NEWS_VIEW';
    const EDIT = 'ROLE_NEWS_EDIT';

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!(1 === preg_match('/^ROLE_NEWS_/', $attribute))) {
            return false;
        }
        // only vote on Post objects inside this voter
        if (!$subject["news"] instanceof News) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a News object, thanks to supports
        /** @var News $news */
        $news = $subject["news"];
        $sport=$subject["sport"];

        switch($attribute) {
            case self::VIEW:
                return $this->canView($news,$sport, $user);
            case self::EDIT:
                return $this->canEdit($news,$sport, $user);
            case self::VALIDATE:
                return $this->canValidate($news,$sport, $user);
        }

        throw new \LogicException('This code should not be reached! Error in news permission definition');
    }

    private function canView(News $news,Sport $sport, User $user)
    {
        //si il n'est pas membre du sport concerne on bloque,
        if($sport->getNom() !="public" && $sport->getNom() !="bds" && !$this->get('bds_membre.manager')->isMembre($sport->getMembres()))
        {
            return false;
        }
        return true;
    }

    private function canEdit(News $news, Sport $sport,User $user)
    {
        if(!canValidate($news,$user) || $news->getAuteur()!=$user)
        {
            return false;
        }
        return true;
    }
    private function canValidate(News $news, Sport $sport, User $user)
    {
        if(!$this->get('bds_membre.manager')->isNewsEditor($sport))
        {
            return false;
        }
        return true;
    }
}

