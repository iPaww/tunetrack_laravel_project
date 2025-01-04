<!-- resources/views/admin/colors/index.blade.php -->
<div class="container">

    <h1>Colors</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('colors.create') }}" class="btn btn-primary mb-3">Add New Color</a>
    <!-- Back Button -->
    <a href="/admin/instruments" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Back
    </a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->name }}</td>
                    <td>
                        <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('colors.destroy', $color->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
