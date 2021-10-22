<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Editoriale;

class Editoriales extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_editorial, $numero_editorial, $direccion_editorial;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.editoriales.view', [
            'editoriales' => Editoriale::latest()
						->orWhere('nombre_editorial', 'LIKE', $keyWord)
						->orWhere('numero_editorial', 'LIKE', $keyWord)
						->orWhere('direccion_editorial', 'LIKE', $keyWord)
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
		$this->nombre_editorial = null;
		$this->numero_editorial = null;
		$this->direccion_editorial = null;
    }

    public function store()
    {
        $this->validate([
		'nombre_editorial' => 'required',
		'numero_editorial' => 'required',
		'direccion_editorial' => 'required',
        ]);

        Editoriale::create([ 
			'nombre_editorial' => $this-> nombre_editorial,
			'numero_editorial' => $this-> numero_editorial,
			'direccion_editorial' => $this-> direccion_editorial
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Editoriale Successfully created.');
    }

    public function edit($id)
    {
        $record = Editoriale::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre_editorial = $record-> nombre_editorial;
		$this->numero_editorial = $record-> numero_editorial;
		$this->direccion_editorial = $record-> direccion_editorial;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre_editorial' => 'required',
		'numero_editorial' => 'required',
		'direccion_editorial' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Editoriale::find($this->selected_id);
            $record->update([ 
			'nombre_editorial' => $this-> nombre_editorial,
			'numero_editorial' => $this-> numero_editorial,
			'direccion_editorial' => $this-> direccion_editorial
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Editoriale Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Editoriale::where('id', $id);
            $record->delete();
        }
    }
}
