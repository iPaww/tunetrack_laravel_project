<h2 class="text-center">Add New Instrument Supply (Models)</h2>

<?php if (isset($error_message)): ?>
    <div style="color: red;"><?= $error_message; ?></div>
<?php endif; ?>

<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" id="btn" data-bs-toggle="modal" data-bs-target="#addSupplyModal">
    Add New Instrument Model
</button>

<!-- Edit Modal Structure -->
<div class="modal fade" id="editSupplyModal" tabindex="-1" aria-labelledby="editSupplyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSupplyModalLabel">Edit Instrument Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit form -->
                <form method="POST" action="update_instrument.php" enctype="multipart/form-data">
                    <input type="hidden" name="model_id" id="edit_model_id"> <!-- Hidden field for model ID -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Model Name:</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description:</label>
                        <input type="text" name="description" id="edit_description" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Price:</label>
                        <input type="text" name="price" id="edit_price" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_color" class="form-label">Color:</label>
                        <input type="text" name="color" id="edit_color" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_serial_number" class="form-label">Serial Number:</label>
                        <input type="text" name="serial_number" id="edit_serial_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Upload Image (optional):</label>
                        <input type="file" name="image" id="edit_image" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Model</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Structure -->
<div class="modal fade" id="addSupplyModal" tabindex="-1" aria-labelledby="addSupplyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSupplyModalLabel">Add New Instrument Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form inside modal -->
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category:</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach ( $categories as $row )
                                <option value="{{ $row['id'] }}">{{ htmlspecialchars($row['category_name']) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type_id" class="form-label">Select Type:</label>
                        <select name="type_id" id="type_id" class="form-select" required>
                            <!-- Types will be dynamically loaded here based on category selection -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="supply_name" class="form-label">Model Name:</label>
                        <input type="text" name="supply_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="text" name="price" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Serial Number:</label>
                        <input type="text" name="serial_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="color" class="form-label">Color:</label>
                        <input type="text" name="color" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image:</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Model</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="container table-responsive-content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Model Name</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Color</th>
                    <th>Serial Number</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ( count($instruments) > 0 )
                        @foreach ( $instruments as $row )
                        <tr>
                            <td>{{ htmlspecialchars($row['model_id']) }}</td>
                            <td>{{ htmlspecialchars($row['name']) }}</td>
                            <td>{{ htmlspecialchars($row['category_name']) }}</td>
                            <td>{{ htmlspecialchars($row['type_name']) }}</td>
                            <td>{{ htmlspecialchars($row['price']) }}</td>
                            <td>{{ htmlspecialchars($row['color']) }}</td>
                            <td>{{ htmlspecialchars($row['serial_number']) }}</td>
                            <td>
                                <img src="{{ asset('assets/images/inventory/uploads/' . htmlspecialchars($row['image']) ) }}" width="50" alt="Image">
                            </td>
                            <td>
                                <a href="delete_instrument.php?id={{ $row['model_id'] }}" class="btn btn-danger">Delete</a>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editSupplyModal"
                                    data-id="{{ $row['model_id'] }}"
                                    data-name="{{ $row['name'] }}"
                                    data-description="{{ $row['description'] }}"
                                    data-price="{{ $row['price'] }}"
                                    data-color="{{ $row['color'] }}"
                                    data-serial="{{ $row['serial_number'] }}">
                                        Edit
                                </button>
                            </td>
                        </tr>
                        @endforeach
                @else
                    <p style='color:blue;'>No supplies found.</p>
                @endif
            </tbody>
        </table>

    </div>
</div>