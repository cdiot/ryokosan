<?php

namespace App\Security\Voter;

use App\Entity\Activity;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ActivityVoter extends Voter
{
    const ACTIVITY_MANAGE = 'activity_manage';

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::ACTIVITY_MANAGE])
            && ($subject instanceof \App\Entity\Activity || $subject === null);
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::ACTIVITY_MANAGE:
                // this is the author!
                if ($subject->getUser() == $user) {
                    return true;
                }

                break;
        }

        return false;
    }
}
