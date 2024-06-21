<?php

use App\Livewire\Empresa\EditarEmpresa;
use App\Models\Empresa;
use App\Models\Usuario;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;


test('deve renderizar a página de edição de empresa após login', function () {
    $usuario = Usuario::factory()->create();
    $empresa = Empresa::factory()->create();

    $this
        ->actingAs($usuario)
        ->get(route('empresas.editar', ['empresa' => $empresa]))
        ->assertOk();
});

test('deve redirecionar para login se não houver usuário logado na página de cadastro de empresa', function () {
    $empresa = Empresa::factory()->create();

    $this
        ->get(route('empresas.editar', ['empresa' => $empresa]))
        ->assertRedirect(route('login'));
});

test('deve editar uma empresa no sistema', function () {
    $empresa = Empresa::factory()->create(['razao_social' => 'Empresa Corporativa SA']);

    Livewire::test(EditarEmpresa::class, ['empresa' => $empresa])
        ->set('form.cnpj', '12345678901234')
        ->set('form.razao_social', 'Empresa LTDA')
        ->set('form.nome_fantasia', 'Super Top Empresa')
        ->set('form.usuario_id', $empresa->usuario_id)
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect(route('empresas.listar', ['usuario' => $empresa->usuario]));

    assertDatabaseHas('empresas', [
        'usuario_id'    => $empresa->usuario->usuario_id,
        'cnpj'          => '12345678901234',
        'razao_social'  => 'Empresa LTDA',
        'nome_fantasia' => 'Super Top Empresa',
    ]);

    assertDatabaseCount('empresas', 1);
});

test('validação das regras de edição de empresa', function ($input) {
    $empresa = Empresa::factory()->create();

    if ($input->rule == 'unique') {
        $field = str_replace('form.', '', $input->field);

        Empresa::factory()->create([$field => $input->value]);

        $input->field = "form.{$input->field}";
    }

    $livewire = Livewire::test(EditarEmpresa::class, ['empresa' => $empresa])
        ->set($input->field, $input->value);

    if (property_exists($input, 'aValue')) {
        $livewire->set($input->aField, $input->aValue);
    }

    $livewire
        ->call('submit')
        ->assertHasErrors([$input->field => $input->rule]);
})->with([
    'usuario_id::required'    => (object)[
        'field' => 'form.usuario_id',
        'value' => '',
        'rule'  => 'required'
    ],
    'usuario_id::numeric'     => (object)[
        'field' => 'form.usuario_id',
        'value' => 'a',
        'rule'  => 'numeric'
    ],
    'cnpj::required'          => (object)[
        'field' => 'form.cnpj',
        'value' => '',
        'rule'  => 'required'
    ],
    'cnpj::min::14'           => (object)[
        'field' => 'form.cnpj',
        'value' => '141',
        'rule'  => 'min:14'
    ],
    'cnpj::max::14'           => (object)[
        'field' => 'form.cnpj',
        'value' => '14141414141414141414714',
        'rule'  => 'max:14'
    ],
    'cnpj::unique'            => (object)[
        'field' => 'form.cnpj',
        'value' => '14141414141414',
        'rule'  => 'unique'
    ],
    'razao_social::required'  => (object)[
        'field' => 'form.razao_social',
        'value' => '',
        'rule'  => 'required'
    ],
    'razao_social::min::3'    => (object)[
        'field' => 'form.razao_social',
        'value' => 'no',
        'rule'  => 'min:3'
    ],
    'razao_social::max::100'  => (object)[
        'field' => 'form.razao_social',
        'value' => str_repeat('laaaa', 150),
        'rule'  => 'max:100'
    ],
    'nome_fantasia::required' => (object)[
        'field' => 'form.nome_fantasia',
        'value' => '',
        'rule'  => 'required'
    ],
    'nome_fantasia::min::3'   => (object)[
        'field' => 'form.nome_fantasia',
        'value' => 'no',
        'rule'  => 'min:3'
    ],
    'nome_fantasia::max::100' => (object)[
        'field' => 'form.nome_fantasia',
        'value' => str_repeat('laaaa', 150),
        'rule'  => 'max:100'
    ],

]);
