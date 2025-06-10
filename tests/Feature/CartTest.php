<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_empty(): void
    {
        $response = $this->get('/api/cart');

        $response->assertStatus(200);
        $response->assertJsonStructure([]);
    }

    public function test_add(): void
    {
        $response = $this->post('/api/cart/update/1', ['count' => 1]);
        $response->assertStatus(200);
        $response = $this->get('/api/cart');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            ["id","name","description","price","image","created_at","updated_at","count"]
        ]);
    }

    public function test_change_quantity(): void
    {
        $count = 2;
        $response = $this->post('/api/cart/update/1', ['count' => $count]);
        $response->assertStatus(200);
        $response = $this->get('/api/cart');
        $response->assertStatus(200);
        $response->assertJsonFragment(['count' => $count]);


        $count = 4;
        $response = $this->post('/api/cart/update/1', ['count' => $count]);
        $response->assertStatus(200);
        $response = $this->get('/api/cart');
        $response->assertStatus(200);
        $response->assertJsonFragment(['count' => $count]);
    }

    public function test_delete_item(): void
    {
        $count = 2;
        $response = $this->post('/api/cart/update/1', ['count' => $count]);
        $response->assertStatus(200);
        $response = $this->get('/api/cart');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            ["id","name","description","price","image","created_at","updated_at","count"]
        ]);


        $count = 0;
        $response = $this->post('/api/cart/update/1', ['count' => $count]);
        $response->assertStatus(200);
        $response = $this->get('/api/cart');
        $response->assertStatus(200);
        $response->assertJsonStructure([]);
    }

    public function test_wrong_quantity(): void
    {
        $count = 'A';
        $response = $this->post('/api/cart/update/1', ['count' => $count]);
        $response->assertStatus(302);
    }

    public function test_wrong_product(): void
    {
        $count = '1';
        $response = $this->post('/api/cart/update/1000', ['count' => $count]);
        $response->assertStatus(404);
    }

    public function test_delete_item_wrong(): void
    {
        $count = '0';
        $response = $this->post('/api/cart/update/1', ['count' => $count]);
        $response->assertStatus(200);
    }

    public function test_add_user_to_cart(): void
    {
        $this->test_add();
        $this->actingAs(User::find(3));
        $this->post('/api/cart/user')->assertStatus(200);
        $this->assertDatabaseHas('carts', ['user_id' => 3]);
    }
}
