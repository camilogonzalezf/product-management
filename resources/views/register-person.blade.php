@extends('welcome')

@section('content')
    <section class="mt-5 d-flex flex-column px-5 justify-content-center align-items-center">

        <div class="w-100 d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegister">
                Registrar persona
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar persona</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-1  rounded  p-3">
                            <form action="{{ route('customers') }}" method="POST">
                                @csrf
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-1 d-flex flex-column px-5  w-100  rounded border border-secondary">
            <h2>Personas registradas</h2>

            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Email</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <div class="modal fade" id="modalConfirm{{ $customer->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cofirmación para borrar persona</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Por favor confirme que desea borrar a {{ $customer->name_customer }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <form action="{{ route('customer-destroy', [$customer->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <tr>
                            <td>{{ $customer->name_customer }}</td>
                            <td>{{ $customer->number_phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalConfirm{{ $customer->id }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>


    </section>
@endsection
