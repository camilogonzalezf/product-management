@extends('welcome')

@section('content')
    <section class="mt-5 d-flex flex-column px-5 ">
        <h2>Registro de usuario</h2>
        <form action="{{ route('customers') }}" method="POST">
            @csrf
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
            @error('name_customer')
                <h6 class="alert alert-danger">Parce que el nombre no esta bien!</h6>
            @enderror
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name_customer">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" class="form-control" name="address">
            </div>
            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="phone" class="form-control" name="number_phone">
            </div>
            <button type="submit" class="btn btn-primary">Registrar persona</button>
        </form>

        <div class="d-flex flex-column mt-5">
            @foreach ($customers as $customer)
                <div class="py-1 d-flex ">
                    <div class="col-md-9 d-flex">
                        <p>{{ $customer->name_customer }}</p>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('customer-destroy', [$customer->id]) }}" method="POST">
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
