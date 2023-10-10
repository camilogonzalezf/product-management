@extends('welcome')

@section('content')
    <section class="mt-5 d-flex flex-column px-5 justify-content-center align-items-center ">
        <div class="w-100 d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegister">
                Registrar producto
            </button>
        </div>
        <div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-1  rounded  p-3">
                            <form action="{{ route('products') }}" method="POST">
                                @csrf
                                @error('name_category')
                                    <h6 class="alert alert-danger">Parece que el nombre del producto no esta bien!</h6>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Nombre producto</label>
                                    <input type="text" class="form-control" name="name_product">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Precio</label>
                                    <input type="phone" class="form-control" name="price">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Categoría</label>
                                    <select name="category_id" class="form-select">
                                        <option>-</option>
                                        @foreach ($categories as $category)
                                            <option value={{ $category->id }}>{{ $category->name_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-1 d-flex flex-column px-5 py-2 w-100 rounded border border-secondary">
            <h2>Productos registrados</h2>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <div class="modal fade" id="modalConfirm{{ $product->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cofirmación para borrar producto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Por favor confirme que desea borrar el producto
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <form action="{{ route('product-destroy', [$product->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <tr>
                            <td>{{ $product->name_product }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalConfirm{{ $product->id }}">
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
