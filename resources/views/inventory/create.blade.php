<!-- resources/views/inventory/create.blade.php -->
<h1>Add New Inventory Item</h1>

<form action="{{ route('inventory.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="stocks">Stocks:</label>
        <input type="number" name="stocks" id="stocks" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <!-- Hidden input for product_code -->
    <input type="number" name="product_code" id="product_code" value="{{ rand(1000, 9999) }}">
    <button type="submit" class="btn btn-primary">Add Item</button>
</form>
