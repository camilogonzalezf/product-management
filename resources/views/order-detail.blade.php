@extends('welcome')

@section('content')
    <section class="mt-2 d-flex flex-column px-5 ">
        <h2>Orden de pedido #{{ $great_order_id }}</h2>
        <div class="d-flex p-2 rounded mb-3" style="background-color: rgb(231, 231, 126);">
            <div class="py-1 d-flex justify-content-between w-75 flex-column">
                <div class="w-auto col-md-9">
                    <b>Nombre :</b>{{ $customer->name_customer }}
                </div>
                <div class="w-auto col-md-9 d-none  d-sm-block">
                    <b>Teléfono :</b>{{ $customer->number_phone }}
                </div>
                <div class="w-auto d-none  d-md-block">
                    <b>Email :</b>{{ $customer->email }}
                </div>
            </div>
            <div class="">
                <h1>Total: $<span>{{ $totalInvoice }}</span>
                </h1>
            </div>
        </div>

        <div class="d-flex w-100 justify-content-center align-items-center flex-column ">
            <div class="w-75 d-flex mb-3 justify-content-end">
                <form class="d-flex" role="search">
                    <input name="searchby" class="form-control me-2" type="search" placeholder="Buscar Producto"
                        aria-label="Buscar" value="{{ $searchby }}">
                    <button class="btn btn-success" type="submit">Buscar</button>
                </form>
            </div>

            <div class="mt-1 d-flex flex-column px-5 py-2  w-100  rounded border border-secondary">
                <h2>Selecciona un Producto</h2>
                <div class="overflow-scroll w-100" style="height: 150px;">
                    <table class="table  table-striped  w-75 ">
                        <thead>
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio unitario</th>
                                <th scope="col">Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name_product }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <form
                                            action="{{ route('order-detail-store', [$customer->id, $product->id, $great_order_id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary m-1">Seleccionar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </div>
                </table>
            </div>
        </div>
        <div class="mt-3 rounded w-100 p-2" style="background-color: rgb(231, 231, 126) ">
            <h2 class="mt-1 px-1">Productos seleccionados</h2>
            <table class="table table-success table-striped mt-2 w-100">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio unitario</th>
                        <th scope="col">Precio Total</th>
                        <th scope="col">Agregar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <form
                                action="{{ route('order-detail-update', [$customer->id, $order->id, $great_order_id, $order->product_id]) }}"
                                method="POST">
                                @method('PATCH')
                                <td>{{ $order->product }}</td>
                                <td><input name="quantity" class="quantity-input" data-n="{{ $order->product_id }}"
                                        style="width:50px;" placeholder="{{ $order->quantity }}" type='text' /></td>
                                <td>
                                    <p class="price" data-n="{{ $order->product_id }}">${{ $order->price }}</p>
                                </td>
                                <td>
                                    <p name="price_total" class="price-total" data-n="{{ $order->product_id }}">
                                        ${{ $order->price_total }}</p>
                                </td>
                                <td>
                                    @csrf
                                    @if ($order->price_total <= 0)
                                        <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                                    @endif
                            </form>
                            </td>
                            <td>
                                <form
                                    action="{{ route('order-detail-destroy', [$order->id, $customer->id, $great_order_id]) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.quantity-input').on('input', function() {
                    n = $(this).data('n');
                    quantity = parseFloat($(this).val());
                    price = parseFloat($(`.price[data-n="${n}"]`).text().replace('$', ''));
                    result = quantity * price;
                    $(`.price-total[data-n="${n}"]`).val(result.toFixed(2));
                });
            });
        </script>


    </section>
@endsection
