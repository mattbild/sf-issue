<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface {

    public function __construct(private readonly UserRepository $userRepository){
    }

    public function refreshUser(UserInterface $user): UserInterface {
        if ($user instanceof User)
            return $user;
        throw new UnsupportedUserException('not supported.');
    }

    public function supportsClass(string $class): bool {
        return $class === User::class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface {
        $user = $this->userRepository->findOneByUsername($identifier);
        if (!$user)
            throw new UserNotFoundException();
        return $user;
    }
}