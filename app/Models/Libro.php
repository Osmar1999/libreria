<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'libros';

    protected $fillable = ['titulo_libro','edicion_libro','fecha_lanzamiento_libro','idioma_libro','descripcion_libro','paginas_libro','autor_libro','categoria_libro','editorial_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descargas()
    {
        return $this->hasMany('App\Models\Descarga', 'id_libro', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function editoriale()
    {
        return $this->hasOne('App\Models\Editoriale', 'id', 'editorial_id');
    }
    
}
