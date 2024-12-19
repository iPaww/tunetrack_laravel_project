<h2>Add New Instrument Type</h2>
<form method="POST">
    <label for="category_id">Select Category:</label>
    <select name="category_id" required>
        @foreach ( $categories as $row )
            <option value="{{ $row['id'] }}">{{ htmlspecialchars($row['category_name']) }}</option>
        @endforeach
    </select><br>

    <label for="type_name">Instrument Type Name:</label>
    <input type="text" name="type_name" required><br>

    <input type="submit" value="Add Instrument Type">
</form>

<div class="table-responsive table-responsive-content">
    <h4>Instrument Types:</h4>
    @if ( count($instrument_types) > 0 )
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Instrument Type</th>
                    <th>Category Name</th>
                </tr>
            </thead>
            <tbody>

            @foreach ( $instrument_types as $index => $row )
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ htmlspecialchars($row['type_name']) }}</td>
                <td>{{ htmlspecialchars($row['category_name']) }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div>No instrument types found</div>
    @endif
</div><br>
