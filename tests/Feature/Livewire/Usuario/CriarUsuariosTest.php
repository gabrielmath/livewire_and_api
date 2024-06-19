<?php

use App\Livewire\Usuario\CriarUsuario;
use App\Models\Usuario;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;


test('deve renderizar a página de cadastro de usuário após login', function () {
    $usuario = Usuario::factory()->create();

    $this
        ->actingAs($usuario)
        ->get(route('usuarios.criar'))
        ->assertOk();
});

test('deve redirecionar para login se não houver usuário logado na página de cadastro de usuário', function () {
    $this
        ->get(route('usuarios.criar'))
        ->assertRedirect(route('login'));
});

test('deve cadastrar um novo usuário no sistema', function() {
    Livewire::test(CriarUsuario::class)
        ->set('form.nome', 'Usuário Teste')
        ->set('form.email', 'teste@user.com')
        ->set('form.senha', '12345678')
        ->set('form.senha_confirmation', '12345678')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect(route('usuarios.listar'));

    assertDatabaseHas('usuarios', [
        'nome' => 'Usuário Teste',
        'email' => 'teste@user.com',
    ]);

    assertDatabaseCount('usuarios', 1);
});

test('validação das regras de cadastro de usuário', function ($input) {
    if ($input->rule == 'unique') {
        Usuario::factory()->create([$input->field => $input->value]);
    }

    $livewire = Livewire::test(CriarUsuario::class)
        ->set($input->field, $input->value);

    if (property_exists($input, 'aValue')) {
        $livewire->set($input->aField, $input->aValue);
    }

    $livewire
        ->call('submit')
        ->assertHasErrors([$input->field => $input->rule]);
})->with([
    'nome::required'     => (object)[
        'field' => 'form.nome',
        'value' => '',
        'rule'  => 'required'
    ],
    'nome::max::100'     => (object)[
        'field' => 'form.nome',
        'value' => str_repeat('*', 101),
        'rule'  => 'max:100'
    ],
    'email::required'    => (object)[
        'field' => 'form.email',
        'value' => '',
        'rule'  => 'required'
    ],
    'email::email'       => (object)[
        'field' => 'form.email',
        'value' => 'not-an-email',
        'rule'  => 'email'
    ],
    'email::max::100'    => (object)[
        'field' => 'form.email',
        'value' => str_repeat('laaaa', 101) . '@user.com',
        'rule'  => 'max:100'
    ],
    /*'email::unique'      => (object)[
        'field'  => 'form.email',
        'value'  => 'admin@user.com',
        'rule'   => 'unique',
        'aField' => 'email_confirmation',
        'aValue' => 'admin@user.com'
    ],*/
    'senha::required' => (object)[
        'field' => 'form.senha',
        'value' => '',
        'rule'  => 'required'
    ],
    'senha::min::8' => (object)[
        'field' => 'form.senha',
        'value' => '123',
        'rule'  => 'min:8'
    ],
    'senha::confirmed' => (object)[
        'field' => 'form.senha',
        'value' => '123456789',
        'rule'  => 'confirmed'
    ],
]);
