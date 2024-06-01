<?php

// Definisci la costante PHPUNIT_TESTING
define('PHPUNIT_TESTING', true);


use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class SquadraTest extends TestCase
{
    private $client;

    protected function setUp(): void
        {
            // Avvia una sessione e simula un utente loggato
            session_start();
            $_SESSION['username'] = 'testuser';

            $this->client = new Client([
                'base_uri' => 'http://localhost/login/',
                'exceptions' => false,
            ]);
        }
    
        public function testButtonPresence()
        {
            // Includi il file PHP che genera l'output
            ob_start();
            require_once 'fanta-formula.php';
            $output = ob_get_clean();
            
            // Verifica che l'output contenga il bottone con l'ID 'botton_costo_scuderia'
            $this->assertStringContainsString('<button class="botton_costo_scuderia"', $output);
        }

        public function testProcessRequest()
        {
            // Simula una richiesta POST
            $action = 'click';
        
            // Includi il file PHP che processa la richiesta
            ob_start();
            require_once 'fanta-formula.php';
            $output = processRequest($action);
    
            // Decodifica la risposta JSON
            $response = json_decode($output, true);
    
            // Asserzioni sulla risposta
            $this->assertEquals('success', $response['status']);
            $this->assertArrayHasKey('cost', $response);
        }
    

    public function testInvalidRequest()
    {
        // Simula una richiesta GET
        $_SERVER['REQUEST_METHOD'] = 'GET';

        // Includi il file PHP che processa la richiesta
        ob_start();
        require_once 'fanta-formula.php';
        $output = ob_get_clean();

        // Decodifica la risposta JSON
        $response = json_decode($output, true);

        // Asserzioni sulla risposta
        $this->assertEquals('error', $response['status']);
        $this->assertEquals('Invalid request', $response['message']);
    }
}
?>