<?php

use App\Livewire\Empresa\CriarEmpresa;
use App\Models\Empresa;
use App\Models\Usuario;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;


test('deve renderizar a página de cadastro de empresa após login', function () {
    $usuario = Usuario::factory()->create();

    $this
        ->actingAs($usuario)
        ->get(route('empresas.criar', ['usuario' => $usuario]))
        ->assertOk();
});

test('deve redirecionar para login se não houver usuário logado na página de cadastro de empresa', function () {
    $this
        ->get(route('empresas.criar'))
        ->assertRedirect(route('login'));
});

test('deve cadastrar uma nova empresa no sistema', function () {
    $usuario = Usuario::factory()->create();

    Livewire::test(CriarEmpresa::class)
        ->set('form.cnpj', '12345678901234')
        ->set('form.razao_social', 'Empresa LTDA')
        ->set('form.nome_fantasia', 'Super Top Empresa')
        ->set('form.usuario_id', $usuario->usuario_id)
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect(route('empresas.listar', ['usuario' => $usuario->usuario_id]));

    assertDatabaseHas('empresas', [
        'usuario_id' => $usuario->usuario_id,
        'cnpj' => '12345678901234',
        'razao_social' => 'Empresa LTDA',
        'nome_fantasia' => 'Super Top Empresa',
    ]);

    assertDatabaseCount('empresas', 1);
});

test('validação das regras de cadastro de empresa', function ($input) {
    if ($input->rule=='unique') {
        $field = str_replace('form.', '', $input->field);

        Empresa::factory()->create([$field => $input->value]);
//        $input->field = "form.{$input->field}";
    }

    $livewire = Livewire::test(CriarEmpresa::class)
        ->set($input->field, $input->value);

    if (property_exists($input, 'aValue')) {
        $livewire->set($input->aField, $input->aValue);
    }

    $livewire
        ->call('submit')
        ->assertHasErrors([$input->field => $input->rule]);
})->with([
    'usuario_id::required' => (object)[
        'field' => 'form.usuario_id',
        'value' => '',
        'rule' => 'required'
    ],
    'usuario_id::numeric' => (object)[
        'field' => 'form.usuario_id',
        'value' => 'a',
        'rule' => 'numeric'
    ],
    'cnpj::required' => (object)[
        'field' => 'form.cnpj',
        'value' => '',
        'rule' => 'required'
    ],
    'cnpj::min::14' => (object)[
        'field' => 'form.cnpj',
        'value' => '141',
        'rule' => 'min:14'
    ],
    'cnpj::max::14' => (object)[
        'field' => 'form.cnpj',
        'value' => '14141414141414141414714',
        'rule' => 'max:14'
    ],
    'cnpj::unique' => (object)[
        'field' => 'form.cnpj',
        'value' => '14141414141414',
        'rule' => 'unique'
    ],
    'razao_social::required' => (object)[
        'field' => 'form.razao_social',
        'value' => '',
        'rule' => 'required'
    ],
    'razao_social::min::3' => (object)[
        'field' => 'form.razao_social',
        'value' => 'no',
        'rule' => 'min:3'
    ],
    'razao_social::max::100' => (object)[
        'field' => 'form.razao_social',
        'value' => str_repeat('laaaa', 150),
        'rule' => 'max:100'
    ],
    'nome_fantasia::required' => (object)[
        'field' => 'form.nome_fantasia',
        'value' => '',
        'rule' => 'required'
    ],
    'nome_fantasia::min::3' => (object)[
        'field' => 'form.nome_fantasia',
        'value' => 'no',
        'rule' => 'min:3'
    ],
    'nome_fantasia::max::100' => (object)[
        'field' => 'form.nome_fantasia',
        'value' => str_repeat('laaaa', 150),
        'rule' => 'max:100'
    ],

]);
