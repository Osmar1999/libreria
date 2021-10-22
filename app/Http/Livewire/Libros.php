<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Libro;
use Livewire\WithFileUploads;

class Libros extends Component
{
    use WithPagination;
	use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $titulo_libro, $edicion_libro, $fecha_lanzamiento_libro, $idioma_libro, $descripcion_libro, $paginas_libro, $autor_libro, $categoria_libro, $editorial_id;
    public $updateMode = false;
	public $pdf, $imageName;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.libros.view', [
            'libros' => Libro::latest()
						->orWhere('titulo_libro', 'LIKE', $keyWord)
						->orWhere('edicion_libro', 'LIKE', $keyWord)
						->orWhere('fecha_lanzamiento_libro', 'LIKE', $keyWord)
						->orWhere('idioma_libro', 'LIKE', $keyWord)
						->orWhere('descripcion_libro', 'LIKE', $keyWord)
						->orWhere('paginas_libro', 'LIKE', $keyWord)
						->orWhere('autor_libro', 'LIKE', $keyWord)
						->orWhere('categoria_libro', 'LIKE', $keyWord)
						->orWhere('editorial_id', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->titulo_libro = null;
		$this->edicion_libro = null;
		$this->fecha_lanzamiento_libro = null;
		$this->idioma_libro = null;
		$this->descripcion_libro = null;
		$this->paginas_libro = null;
		$this->autor_libro = null;
		$this->categoria_libro = null;
		$this->editorial_id = null;
    }

    public function store()
    {
        $this->validate([
		'titulo_libro' => 'required',
		'edicion_libro' => 'required',
		'fecha_lanzamiento_libro' => 'required',
		'idioma_libro' => 'required',
		'descripcion_libro' => 'required',
		'paginas_libro' => 'required',
		'autor_libro' => 'required',
		'categoria_libro' => 'required',
        ]);

        Libro::create([ 
			'titulo_libro' => $this-> titulo_libro,
			'edicion_libro' => $this-> edicion_libro,
			'fecha_lanzamiento_libro' => $this-> fecha_lanzamiento_libro,
			'idioma_libro' => $this-> idioma_libro,
			'descripcion_libro' => $this-> descripcion_libro,
			'paginas_libro' => $this-> paginas_libro,
			'autor_libro' => $this-> autor_libro,
			'categoria_libro' => $this-> categoria_libro,
			'editorial_id' => $this-> editorial_id
        ]);
		
        $this->pdf->store('pdf');
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Libro Successfully created.');
    }

    public function edit($id)
    {
        $record = Libro::findOrFail($id);

        $this->selected_id = $id; 
		$this->titulo_libro = $record-> titulo_libro;
		$this->edicion_libro = $record-> edicion_libro;
		$this->fecha_lanzamiento_libro = $record-> fecha_lanzamiento_libro;
		$this->idioma_libro = $record-> idioma_libro;
		$this->descripcion_libro = $record-> descripcion_libro;
		$this->paginas_libro = $record-> paginas_libro;
		$this->autor_libro = $record-> autor_libro;
		$this->categoria_libro = $record-> categoria_libro;
		$this->editorial_id = $record-> editorial_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'titulo_libro' => 'required',
		'edicion_libro' => 'required',
		'fecha_lanzamiento_libro' => 'required',
		'idioma_libro' => 'required',
		'descripcion_libro' => 'required',
		'paginas_libro' => 'required',
		'autor_libro' => 'required',
		'categoria_libro' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Libro::find($this->selected_id);
            $record->update([ 
			'titulo_libro' => $this-> titulo_libro,
			'edicion_libro' => $this-> edicion_libro,
			'fecha_lanzamiento_libro' => $this-> fecha_lanzamiento_libro,
			'idioma_libro' => $this-> idioma_libro,
			'descripcion_libro' => $this-> descripcion_libro,
			'paginas_libro' => $this-> paginas_libro,
			'autor_libro' => $this-> autor_libro,
			'categoria_libro' => $this-> categoria_libro,
			'editorial_id' => $this-> editorial_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Libro Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Libro::where('id', $id);
            $record->delete();
        }
    }
}
