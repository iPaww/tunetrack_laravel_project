<h2>Add New Category</h2>
<form method="POST">
    <label for="category_name">Category Name:</label>
    <input type="text" name="category_name" required><br><br>
    <input type="submit" value="Add Category">
</form>

<div class="container mt-5">
    <div class="table-responsive table-responsive-content">
        <h4>Category Table</h4>
        @if ( count($categories) > 0 )
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ( $categories as $index => $row )
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ htmlspecialchars($row['category_name']) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div>No categories found.</div>
        @endif
    </div>
</div>