<?php

namespace App;

use PDO;

class Auth{

    private $pdo;
    private $loginPath;

    private $session;

    public function __construct(PDO $pdo, string $loginPath, array &$session)
    {
        $this->pdo = $pdo;
        $this->loginPath = $loginPath;
        $this->session = $session;
    }

    public function user(): ?User
    {
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $id = $_SESSION['auth'] ?? null;
        if ($id === null){
            return null;
        }

        $query = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $query->execute([$id]);
        $user = $query->fetchObject(User::class);
        return $user ?: null;
    }

    public function login(string $username, string $password): ?User
    {
        //Trouve l'utilisateur correspondant au username
        $query = $this->pdo->prepare('SELECT * FROM users WHERE username = :username');
        $query->execute(['username' => $username]);
        $user = $query->fetchObject(User::class);
        if($user === false){
            return null;
        }
        //On vérifie password_verify que l'utilisateur corresponde
        if (password_verify($password, $user->password))
        {
            if (session_status() === PHP_SESSION_NONE){
                session_start();
            }
            session_start();
            $_SESSION['auth'] = $user->id;
            return $user;
        }
        return null;        
    }

    public function requireRole(string ...$roles): void
    {
        $user = $this->user();
        if ($user === null || !in_array($user->role, $roles))
        {
            header("Location: {$this->loginPath}?forbid=1");
            exit();
        } 
    }
}