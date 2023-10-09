@extends('welcome')

@section('content')
    <section class="mt-5 d-flex flex-column px-5 ">
        <h2>Registro de Categorías</h2>
        <form action="{{ route('categories') }}" method="POST">
            @csrf
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
            @error('name_category')
                <h6 class="alert alert-danger">Parece que el nombre de la categoría no esta bien!</h6>
            @enderror
            <div class="mb-3">
                <label class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" name="name_category">
            </div>
            <button type="submit" class="btn btn-primary">Registrar categoría</button>
        </form>
        <div class="d-flex flex-column mt-5">
            @foreach ($categories as $category)
                <div class="py-1 d-flex ">
                    <div class="col-md-9 d-flex">
                        <p>{{ $category->name_category }}</p>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('category-destroy', [$category->id]) }}" method="POST">
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
