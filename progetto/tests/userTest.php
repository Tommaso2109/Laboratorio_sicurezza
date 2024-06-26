<?php

use PHPUnit\Framework\TestCase;

require 'C:/xampp/htdocs/login/src/User.php';

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

<?php

    if (file_exists(dirname(_DIR_) . '\incremento_ban.php')) {
        echo "Il file esiste";
    } else {
        echo "Il file non esiste";
    }

    require_once dirname(_DIR_) . '\incremento_ban.php';

    use PHPUnit\Framework\TestCase;

        class MysqliWrapper {
            private $mysqli;

            public function __construct() {
                $this->mysqli = new mysqli('localhost', 'user', 'password', 'database');
            }

            public function prepare($query) {
                return $this->mysqli->prepare($query);
            }

            // Aggiungi altri metodi secondo necessità...

            public function close() {
                $this->mysqli->close();
            }
        }

        class UserTest extends TestCase{
            public function testToggleBan() {
                $username = 'testUser';
                $mysqli = $this->createMock(MysqliWrapper::class);

                $stmt1 = $this->createMock(mysqli_stmt::class);
                $stmt2 = $this->createMock(mysqli_stmt::class);

                $mysqli->method('prepare')
                    ->will($this->onConsecutiveCalls($stmt1, $stmt2));

                $stmt1->expects($this->once())
                    ->method('bind_param')
                    ->with($this->equalTo('s'), $this->equalTo($username));

                $stmt2->expects($this->once())
                    ->method('bind_param')
                    ->with($this->equalTo('s'), $this->equalTo($username));

                $stmt1->expects($this->once())
                    ->method('execute')
                    ->willReturn(true);

                $stmt2->expects($this->once())
                    ->method('execute')
                    ->willReturn(true);

                
                $resultMock = $this->createMock(mysqli_result::class);
                $resultMock->method('fetch_assoc')->willReturn(['ban' => 0]);

                $stmt1->method('get_result')->willReturn($resultMock);

                $user = new User($mysqli);
                $result = $user->toggleBan($username);

                $this->assertTrue($result);
         }
    }