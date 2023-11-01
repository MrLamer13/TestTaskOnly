<?php

namespace src\models;

use src\models\User;
use PDO;

class UserProvider
{
    public function __construct(
        private PDO $pdo
    )
    {
    }

    public function registerUser(User $user): bool
    {
        $statement = $this->pdo
            ->prepare(
                'INSERT INTO users (name, phone, email, password) VALUES (:name, :phone, :email, :password)'
            );

        return $statement->execute([
            'name' => $user->getName(),
            'phone' => $user->getPhone(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
    }

    public function checkedUser(string $field, string $value): bool
    {
        $statement = $this->pdo
            ->prepare(
                "SELECT * FROM users WHERE $field = :value"
            );
        $statement->execute([
            'value' => $value
        ]);

        if ($statement->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public function getByEmailAndPassword(string $email, string $password): ?User
    {
        $statement = $this->pdo
            ->prepare(
                'SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1'
            );
        $statement->execute([
            'email' => $email,
            'password' => $password
        ]);

        return $statement->fetchObject(User::class) ?: null;
    }

    public function getByPhoneAndPassword(string $phone, string $password): ?User
    {
        $statement = $this->pdo
            ->prepare(
                'SELECT * FROM users WHERE phone = :phone AND password = :password LIMIT 1'
            );
        $statement->execute([
            'phone' => $phone,
            'password' => $password
        ]);

        return $statement->fetchObject(User::class) ?: null;
    }

    public function updateUser(User $user): bool
    {
        $statement = $this->pdo
            ->prepare(
                'UPDATE users SET name = :name, email = :email, phone = :phone, password = :password WHERE id = :id'
            );

        return $statement->execute([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'phone' => $user->getPhone(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
    }
}