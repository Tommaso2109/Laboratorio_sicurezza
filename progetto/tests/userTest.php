<?php

use PHPUnit\Framework\TestCase;

require 'C:/xampp/htdocs/login/src/user.php';

class UserTest extends TestCase
{
    private $db;
    private $user;

    protected function setUp(): void
    {
        $this->db = new mysqli('127.0.0.1', 'root', '', 'statistiche');
        $this->user = new User($this->db);
    }

   public function testRegisterNewUser()
{
    $username = 'testuser';
    $password = 'testpassword';

    // Inizia una transazione
    $this->db->begin_transaction();

    $result = $this->user->register($username, $password);

    // Fai un rollback della transazione
    $this->db->rollback();

    $this->assertTrue($result);
}

public function testRegisterExistingUser()
{
    $username = 'existinguser';
    $password = 'existingpassword';

    // Inizia una transazione
    $this->db->begin_transaction();

    $result = $this->user->register($username, $password);

    // Fai un rollback della transazione
    $this->db->rollback();

    $this->assertFalse($result);
}
}