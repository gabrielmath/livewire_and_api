<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $documentList = [
            '68546277000158',
            '73497330000108',
            '27333869000104',
            '70326617000187',
            '78412637000182',
            '64693385000100',
            '46774948000103',
            '28250760000176',
            '84913742000106',
            '17774036000125',
        ];

        shuffle($documentList);

        $totalUsuarios = $this->totalUsuarios();

        return [
            'usuario_id' => ($totalUsuarios > 0 ? rand(1, $totalUsuarios):Usuario::factory()),
            'cnpj' => $this->geraCnpj(14),
            'nome_fantasia' => $this->faker->company,
            'razao_social' => "{$this->faker->company} {$this->faker->companySuffix}",
        ];
    }

    private function totalUsuarios(): int
    {
        return Usuario::all()->count();
    }

    private function geraCnpj($limit)
    {
        $code = 0;
        for ($i = 0; $i < $limit - 1; $i++) {
            $code .= mt_rand(0, 9);
        }
        return $code;
    }

}
