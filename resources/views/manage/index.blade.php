
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __(' Order List Approval') }}
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
                                <th>Order Units</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            @if (is_null($item->status))
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->customer_name }}</td>
                                    <td>{{ $item->order_units }}</td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td class="d-flex">
                                        <form action="{{ route('manage.approve', $item->id) }}" method="POST" class="me-2">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">APPROVE</button>
                                        </form>
                                                                                
                                        <form id="disapproveForm{{ $item->id }}" action="{{ route('manage.disapprove', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDisapprove({{ $item->id }})">DISAPPROVE</button>
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
    <script>
        function confirmDisapprove(itemId) {
            // Show a confirmation dialog
            if (confirm("Are you sure you want to disapprove this item?")) {
                // If user clicks 'OK', submit the form
                document.getElementById('disapproveForm' + itemId).submit();
            } else {
                // If user clicks 'Cancel', do nothing
                return false;
            }
        }
    </script>
    