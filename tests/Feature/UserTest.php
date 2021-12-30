<?php

namespace Tests\Feature;

use http\Client\Curl\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;



class UserTest extends TestCase
{
 use DatabaseTransactions; // fazer rolback dos dados


    public function testCriarUsuario()
    {
        $dados = [
          'name' => 'Teste Fixo2',
          'email' => 'testefixo2@teste.com',
          'password' => 'teste'
        ];

       // $responde = $this->post('/api/user', $dados);
       $responde = $this->postJson('/api/user', $dados);

       $responde->assertStatus(201);
        $resposta = (array) json_decode($responde->getContent());


        $this->assertDatabaseHas('users', ['name' => $dados['name'],'email' => $dados['email']]);
    }

    public function editarUsuario($id)
    {


       $teste = DB::table('users')->where('id',$id)->first();
        $dados = [
            'name' => 'Teste Edição',
            'email' => 'testefixo2@teste.com',
        ];
        $teste = $this->put('/api/user/'.$teste->id,$dados);
        $teste->assertStatus(200);
        $resposta = (array) json_decode($teste->getContent());
        $this->assertArrayHasKey('name',$resposta);
        $this->assertArrayHasKey('email',$resposta);
        $this->assertArrayHasKey('id',$resposta);

    }

   public function verUsuario($id)
    {

        $teste = DB::table('users')->where('id',$id)->first();
        $teste = $this->get('/api/user/'.$teste->id);
        $teste->assertStatus(200);
        $resposta = (array) json_decode($teste->getContent());
        $this->assertArrayHasKey('name',$resposta);
        $this->assertArrayHasKey('email',$resposta);
        $this->assertArrayHasKey('id',$resposta);

    }

}
