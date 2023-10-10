@extends('welcome')

@section('content')
    <section class="mt-5 d-flex flex-column px-5 justify-content-center align-items-center ">
        <div class="w-100 d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegister">
                Registrar categoría
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-1  rounded  p-3">

                            <form action="{{ route('categories') }}" method="POST">
                                @csrf
                                @error('name_category')
                                    <h6 class="alert alert-danger">Parece que el nombre de la categoría no esta bien!</h6>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Nombre de la Categoría</label>
                                    <input type="text" class="form-control" name="name_category">
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar categoría</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-1 d-flex flex-column px-5  w-100  rounded border border-secondary">
            <h2>Categorías registradas</h2>

            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre categoría</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <!-- Modal Eliminar-->
                        <div class="modal fade" id="modalConfirm{{ $category->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cofirmación para borrar categoría
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Por favor confirme que desea borrar categoría
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <form action="{{ route('category-destroy', [$category->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <tr>
                            <td>{{ $category->name_category }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalConfirm{{ $category->id }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
