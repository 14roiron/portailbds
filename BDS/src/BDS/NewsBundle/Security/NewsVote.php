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
                return $this->canView($post, $user);
            case self::EDIT:
                return $this->canEdit($post, $user);
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
        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        return !$post->isPrivate();
    }

    private function canEdit(News $news, User $user)
    {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return $user === $post->getOwner();
    }
}

}