<h2>Add New Supply</h2>
<form method="POST" enctype="multipart/form-data">
    <label for="category_id">Select Category:</label>
    <select name="category_id" required>
        @foreach ( $categories as $row )
            <option value="{{ $row['id'] }}">{{ htmlspecialchars($row['category_name']) }}</option>
        @endforeach
    </select><br>

    <label for="supply_name">Supply Name:</label>
    <input type="text" name="supply_name" required><br>

    <label for="price">Price:</label>
    <input type="text" name="price" required><br>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" required><br>

    <!-- Input for Image Upload -->
    <label for="image">Upload Image:</label>
    <input type="file" name="image" accept="image/*" required><br>

    <input type="submit" value="Add Supply">
</form>

<div class="table-responsive table-responsive-content">
    <h4>Supplies:</h4>
    @if (count($supplies) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Supply Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
            @foreach ( $supplies as $index => $row )
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ htmlspecialchars($row['category_name']) }}</td>
                    <td>{{ htmlspecialchars($row['name']) }}</td>
                    <td>{{ htmlspecialchars($row['price']) }}</td>
                    <td>{{ htmlspecialchars($row['quantity']) }}</td>
                    <td>
                        <img src="{{ asset('assets/images/inventory/uploads/' . htmlspecialchars($row['image']) ) }}" alt="Supply Image" style="width: 100px; height: auto;">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p style='color:blue;'>No supplies found.</p>
    @endif
</div>
<br>