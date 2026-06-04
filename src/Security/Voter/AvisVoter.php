<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use App\Entity\Avis;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AvisVoter extends Voter
{
    const ADD_EDIT = "AVIS_ADD_EDIT";
    const DELETE = "AVIS_DELETE";

    private $security;
    public function __construct(Security $security) 
    {
        $this->security = $security;
    }
    // Vérifie que ce qu'on a envoyé au Voter est cohérent.
    protected function supports(string $attribute, $avis): bool 
    {
        // Vérifier qu'on a envoyé un attribut dans la méthode (soit ADD_EDIT soit DELETE)
        if(!in_array($attribute, [self::ADD_EDIT, self::DELETE])) {
            return false;
        }
        // Vérifier qu'on a la bonne Entity
        if(!$avis instanceof Avis) {
            return false;
        }
        return true;
    }

    // Vérifie si l'utilisateur est connecté et vérifie ce que bon nous semble en fonction du contexte de notre projet.
    protected function voteOnAttribute($attribute, $avis, TokenInterface $token): bool 
    {
        // On récupère l'utilisateur à partir du token
        $user = $token->getUser();

        // On vérifie si l'utilisateur est connecté
        if ($user instanceof UserInterface) return false;
            
        //On vérifie si l'utilisateur est admin
        if ($this->security->isGranted('ROLE_ADMIN')) return true;

        //On vérifie  les permissions
        switch($attribute) {
            case self::ADD_EDIT:
                // On vérifie si l'utilisateur peut add et edit
                return $this->canAddEdit();
                break;
            case self::DELETE:
                // On vérifie si l'utilisateur peut supprimer
                return $this->canAddEdit();
                break;

        }

    }

    private function canAddEdit() {
        return $this->security->isGranted('ROLE_PRODUCT_ADMIN');
    }

    private function canDelete() {
        return $this->security->isGranted('ROLE_PRODUCT_ADMIN');
    }
}