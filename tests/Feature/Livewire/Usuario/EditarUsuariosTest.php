<?php

use App\Livewire\Usuario\CriarUsuario;
use App\Livewire\Usuario\EditarUsuario;
use App\Models\Usuario;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;


test('deve renderizar a página de edição de usuário após login', function () {
    $usuario = Usuario::factory()->create();

    $this
        ->actingAs($usuario)
        ->get(route('usuarios.editar', ['usuario' => $usuario->usuario_id]))
        ->assertOk();
});

test('deve redirecionar para login se não houver usuário logado na página de edição de usuário', function () {
    $this
        ->get(route('usuarios.editar', ['usuario' => Usuario::factory()->create()]))
        ->assertRedirect(route('login'));
});

test('deve editar um usuário no sistema', function() {
    $usuario = Usuario::factory()->create([
        'nome' => 'Usuario',
        'email' =>  'usuario@email.com',
    ]);

    Livewire::test(EditarUsuario::class, ['usuario' => $usuario])
        ->set('form.nome', 'Usuário Teste')
        ->set('form.email', 'teste@user.com')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect(route('usuarios.listar'));

    assertDatabaseHas('usuarios', [
        'nome' => 'Usuário Teste',
        'email' => 'teste@user.com',
    ]);

    assertDatabaseCount('usuarios', 1);
});

test('validação das regras de edição de usuário', function ($input) {
    $usuario = Usuario::factory()->create();

    if ($input->rule == 'unique') {
        $field = str_replace('form.','', $input->field);
        Usuario::factory()->create([$field => $input->value]);

        $input->field = "form.{$input->field}";
    }
    $livewire = Livewire::test(EditarUsuario::class, ['usuario' => $usuario])
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
    'email::unique'      => (object)[
        'field'  => 'email',
        'value'  => 'admin@user.com',
        'rule'   => 'unique',
    ],
]);
