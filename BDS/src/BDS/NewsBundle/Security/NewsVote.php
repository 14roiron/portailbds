<?php

namespace BDS\NewsBundle\Security;
 
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use UserBundle\Entity\Membre;
use UserBundle\Entity\User;
use NewsBundle\Entity\News;
class NewsVoter implements VoterInterface
{
    const VIEW = 'ROLE_NEWS_VIEW';
    const EDIT = 'ROLE_NEWS_EDIT';

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!(1 === preg_match('/^ROLE_NEWS_/', $attribute)) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof News) {
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
        $news = $subject;

        switch($attribute) {
            case self::VIEW:
                return $this->canView($news, $user);
            case self::EDIT:
                return $this->canEdit($news, $user);
            case self::VALIDATE:
                return $this->canValidate($news, $user);
        }

        throw new \LogicException('This code should not be reached! Error in news permission definition');
    }

    private function canView(News $news, User $user)
    {
        $sport=$news->getSport();
        //si il n'est pas membre du sport concerne on bloque,
        if($sport->getNom() !="public" && !$this->get('bds_membre.manager')->isMembre($sport->getMembres()))
        {
            return false;
        }
        return true;
    }

    private function canEdit(News $news, User $user)
    {
        $sport=$news->getSport();
        if(!canValidate($news,$user) || $news->getAuteur()!=$user)
        {
            return false;
        }
        return true;
    }
    private function canValidate(News $news, User $user)
    {
        $sport=$news->getSport();
        if(!$this->get('bds_membre.manager')->isNewsEditor($sport))
        {
            return false;
        }
        return true;
    }
}

}