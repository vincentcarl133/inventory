
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Order List') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- LINKS FOR DESIGN --}}
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

                    
                    <div class="container p-5">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Order Units</th>
                                    <th>Order Date</th>
                                    <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            @foreach ($orders as $order)
                            @if (is_null($order->shipment_status))
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->order_units }}</td>
                            <td>{{ $order->order_date }}</td>

                            <td>
                                <form action="{{ route('shipment.delivered', ['id' => $order->id]) }}" method="POST" class="me-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-info">Delivered</button>
                                </form>
                            </td>
                        </tr>
                        @endif
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
                        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
                    
                    <script>
                        $(document).ready(function() {
                            $('#example').DataTable();
                        });
                    </script>

                </div>
            </div>
        </div>
    </x-app-layout>
