<?php

namespace Bolero\Plugins\Authentication\Repositories;

use Bolero\Framework\Dbal\DataMapper;
use Bolero\Framework\Dbal\Entity;
use Bolero\Plugins\Authentication\Entities\User;
use Doctrine\DBAL\Exception;

class UserMapper extends DataMapper
{

    /**
     * @throws Exception
     */
    public function insert(User | Entity &$entity): void
    {
        $stmt = $this->connection->prepare("
            INSERT INTO users (email, password, created_at)
            VALUES (:email, :password, :created_at)
        ");

        $stmt->bindValue(":email", $entity->getEmail());
        $stmt->bindValue(":password", $entity->getPassword());
        $stmt->bindValue(":created_at", $entity->getCreatedAt()->format('Y-m-d H:i:s'));

        $stmt->executeStatement();
    }
}
