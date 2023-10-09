@extends('welcome')

@section('content')
    <section class="mt-5 d-flex flex-column px-5 ">
        <h2>Registro de Producto</h2>
        <form action="{{ route('products') }}" method="POST">
            @csrf
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
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

        <div class="d-flex flex-column mt-5">
            @foreach ($products as $product)
                <div class="py-1 d-flex ">
                    <div class="col-md-9 d-flex">
                        <p>{{ $product->name_product }}</p>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('product-destroy', [$product->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
