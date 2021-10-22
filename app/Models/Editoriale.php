<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editoriale extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'editoriales';

    protected $fillable = ['nombre_editorial','numero_editorial','direccion_editorial'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libros()
    {
        return $this->hasMany('App\Models\Libro', 'editorial_id', 'id');
    }
    
}
