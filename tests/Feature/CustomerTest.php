<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use TechChallenge\Infra\DB\Eloquent\Customer\Model as Customer;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para verificar se o endpoint de show retorna um cliente existente.
     */
    public function test_show_customer_successfully()
    {
        // Arrange: Cria um cliente no banco de dados
        $customer = Customer::factory()->create([
            'id' => 1,
            'name' => 'John Doe',
            'cpf' => '12345678901',
            'email' => 'john@example.com',
        ]);

        // Act: Faz uma requisição GET para o endpoint de show
        $response = $this->getJson('/customer/' . $customer->id);

        // Assert: Verifica se o retorno está correto
        $response->assertStatus(200) // Código HTTP 200
                 ->assertJson([
                     'id' => $customer->id,
                     'name' => 'John Doe',
                     'cpf' => '12345678901',
                     'email' => 'john@example.com',
                 ]);
    }

    /**
     * Teste para verificar se o endpoint de show retorna 404 quando o cliente não existe.
     */
    public function test_show_customer_not_found()
    {
        // Act: Faz uma requisição GET para um cliente inexistente
        $response = $this->getJson('/customer/999');

        // Assert: Verifica se retorna erro 404
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Customer not found.', // Certifique-se de que a mensagem corresponda à do controller
                 ]);
    }
}
