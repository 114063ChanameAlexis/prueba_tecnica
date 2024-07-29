<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarea
 * 
 * @property int $Idtarea
 * @property string $NombreTarea
 * @property string|null $Descripcion
 * @property int|null $Idtipo_tarea
 * @property Carbon|null $FechaCreacion
 * @property Carbon|null $FechaModificacion
 * @property int|null $Idestado
 * @property int|null $Idusuario_asignado
 * @property int|null $TareaFinalizada
 * 
 * @property TipoTarea|null $tipo_tarea
 * @property Estado|null $estado
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Tarea extends Model
{
	protected $table = 'tarea';
	protected $primaryKey = 'Idtarea';
	public $timestamps = false;

	protected $casts = [
		'Idtipo_tarea' => 'int',
		'FechaCreacion' => 'datetime',
		'FechaModificacion' => 'datetime',
		'Idestado' => 'int',
		'Idusuario_asignado' => 'int',
		'TareaFinalizada' => 'int'
	];

	protected $fillable = [
		'NombreTarea',
		'Descripcion',
		'Idtipo_tarea',
		'FechaCreacion',
		'FechaModificacion',
		'Idestado',
		'Idusuario_asignado',
		'TareaFinalizada'
	];

	public function tipo_tarea()
	{
		return $this->belongsTo(TipoTarea::class, 'Idtipo_tarea');
	}

	public function estado()
	{
		return $this->belongsTo(Estado::class, 'Idestado');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'Idusuario_asignado');
	}
}
