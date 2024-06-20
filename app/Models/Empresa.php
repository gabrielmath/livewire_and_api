<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empresa extends Model
{
    use HasFactory;

    public const CREATED_AT = 'criado_em';

    public const UPDATED_AT = 'atualizado_em';


    protected $table = 'empresas';

    protected $primaryKey = 'empresa_id';

    protected $fillable = [
        'usuario_id',
        'cnpj',
        'razao_social',
        'nome_fantasia',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }
}
