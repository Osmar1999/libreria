@section('title', __('Libros'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Libro Listing </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Libros">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Add Libros
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.libros.create')
						@include('livewire.libros.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Titulo Libro</th>
								<th>Edicion Libro</th>
								<th>Fecha Lanzamiento Libro</th>
								<th>Idioma Libro</th>
								<th>Descripcion Libro</th>
								<th>Paginas Libro</th>
								<th>Autor Libro</th>
								<th>Categoria Libro</th>
								<th>Editorial Id</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($libros as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->titulo_libro }}</td>
								<td>{{ $row->edicion_libro }}</td>
								<td>{{ $row->fecha_lanzamiento_libro }}</td>
								<td>{{ $row->idioma_libro }}</td>
								<td>{{ $row->descripcion_libro }}</td>
								<td>{{ $row->paginas_libro }}</td>
								<td>{{ $row->autor_libro }}</td>
								<td>{{ $row->categoria_libro }}</td>
								<td>{{ $row->editorial_id }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Libro id {{$row->id}}? \nDeleted Libros cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $libros->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>