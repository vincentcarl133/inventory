<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('inventory.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="form-group">
                        <label for="edit-name{{ $item->id }}">Name:</label>
                        <input type="text" class="form-control" id="edit-name{{ $item->id }}" name="name" value="{{ $item->name }}">
                    </div>
                    <div class="form-group">
                        <label for="edit-stocks{{ $item->id }}">Stocks:</label>
                        <input type="number" class="form-control" id="edit-stocks{{ $item->id }}" name="stocks" value="{{ $item->stocks }}">
                    </div>
                    <div class="form-group">
                        <label for="edit-price{{ $item->id }}">Price:</label>
                        <input type="number" step="0.01" class="form-control" id="edit-price{{ $item->id }}" name="price" value="{{ $item->price }}">
                    </div>
                    <div class="form-group">
                        <label for="edit-description{{ $item->id }}">Description:</label>
                        <textarea class="form-control" id="edit-description{{ $item->id }}" name="description">{{ $item->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
