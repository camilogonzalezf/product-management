@extends('welcome')

@section('content')
    <section class="mt-5 d-flex flex-column px-5 ">
        <h2>Buscar persona</h2>
        <form class="d-flex justify-content-end" role="search">
            <input name="searchby" class="form-control me-2 w-25" type="search" placeholder="Buscar" aria-label="Buscar"
                value="{{ $searchby }}">
            <button class="btn btn-success" type="submit">Buscar</button>
        </form>
        <div class="mt-3 d-flex flex-column px-5  w-100  rounded border border-secondary">
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
                                <form action="{{ route('orders', [$customer->id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-primary btn-sm">Tomar pedido</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
