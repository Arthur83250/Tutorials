<?php

use App\Auth;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase {

        
    /**
     * auth
     *
     * @var Auth
     */
    private $auth;

        
    /**
     * 
     * @before setAuth
     */
    public function setAuth(){
        $pdo = new PDO("sqlite::memory:", null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $pdo->query('CREATE TABLE users (username TEXT, password TEXT)');
        for ($i = 1; $i <= 10; $i++)
        {
            $password = password_hash("user$i", PASSWORD_BCRYPT, ['cost' => 5]);
            $pdo->query("INSERT INTO users (username, password) VALUES ('user$i', '$password')");
        }
        $this->auth = new Auth($pdo, "/login");
    }

    public function testLoginWithBadUsername(){
        $this->assertNull($this->auth->login('aze', 'aze'));
    }

    public function testLoginWithBadPassword(){
        $this->assertNull($this->auth->login('user1', 'aze'));   
    }

    public function testLoginSuccess(){
        $this->assertObjectHasProperty("username", $this->auth->login('user1', 'user1'));  
    }
}