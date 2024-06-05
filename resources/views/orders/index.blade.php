    <!-- resources/views/layouts/app.blade.php -->

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order Creation') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="container py-5">
                        <h2>Order Form</h2>
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleDataList" class="form-label">Product Name</label>
                                    <input class="form-control" list="datalistOptions" id="product_name"
                                        name="product_name" placeholder="Type to search...">
                                        <datalist id="datalistOptions">
                                            @foreach($inventoryData as $item)
                                            <option value="{{ $item->name }}"></option>
                                            @endforeach
                                        </datalist>
        
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="product_code" class="form-label">Product Code</label>
                                    <input type="number" class="form-control" id="product_code" name="product_code"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="order_units" class="form-label">Order Units</label>
                                    <input type="number" class="form-control" id="order_units" name="order_units"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="order_date" class="form-label">Order Date</label>
                                    <input type="date" class="form-control" id="order_date" name="order_date"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="customer_name" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <input class="form-control" id="comment" name="comment" required></input>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input class="form-control" type="hidden" id="total_amount" name="total_amount" value ="" required></input>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Order</button>
                        </form>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                </div>
            </div>
        </div>
    </x-app-layout>



    <script>
        document.getElementById('product_code').addEventListener('change', function() {
            var productCode = this.value;
            var productNames = @json($inventoryData->pluck('name', 'product_code'));

            // Update the product name input based on the entered product code
            if (productNames.hasOwnProperty(productCode)) {
                document.getElementById('product_name').value = productNames[productCode];
            } else {
                document.getElementById('product_name').value = '';
            }
        });


        document.getElementById('product_name').addEventListener('change', function() {
        var productName = this.value;
        var productCodes = @json($inventoryData->pluck('product_code', 'name'));

        // Update the product code input based on the entered product name
        var productCode = productCodes[productName];
        if (productCode !== undefined) {
            document.getElementById('product_code').value = productCode;
        } else {
            document.getElementById('product_code').value = '';
        }
    });
    </script>