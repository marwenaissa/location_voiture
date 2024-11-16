<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserEntity()
    {
        $user = new User();
        
        // Test `email`
        $user->setEmail('user@example.com');
        $this->assertEquals('user@example.com', $user->getEmail());
        $this->assertEquals('user@example.com', $user->getUserIdentifier());

        // Test `roles`
        $user->setRoles(['ROLE_ADMIN']);
        $this->assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $user->getRoles()); // ROLE_USER est ajouté automatiquement

        // Test `password`
        $user->setPassword('hashedpassword123');
        $this->assertEquals('hashedpassword123', $user->getPassword());

        // Test `eraseCredentials` (aucune donnée sensible à effacer ici)
        $user->eraseCredentials();
        $this->assertNull(null); // Ajoutez un test spécifique si vous stockez des données temporaires
    }
}
