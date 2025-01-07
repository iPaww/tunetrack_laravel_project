<style>
    table tbody tr {
        cursor: pointer;
    }

    .table tbody tr td {
        background: transparent;
    }

    table tbody tr:hover {
        filter: brightness(85%);
    }
</style>

<div class="container mt-5 min-vh-100">
    <div class="mb-2">
        <a href="/shop" class="btn btn-outline-dark border border-0 fw-bold">&laquo; Back to shop</a>
    </div>
    <h2>Your Orders (Receipt)</h2>
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            @if ( count($orders) > 0 )
                <tbody>
                    @foreach ($orders as $row)
                        <tr data-id="{{ $row->id }}"
                            @class([
                                'bg-white' => $row->status == 1,
                                'bg-warning-subtle' => $row->status == 2,
                                'bg-success-subtle' => $row->status == 3,
                                'bg-danger-subtle' => $row->status == 4,
                            ])
                        >
                            <td>{{ str_pad($row->id, 10, "0", STR_PAD_LEFT) }}</td>
                            <td>{{ $row->payment_method }}</td>
                            <td>{{ $statuses[$row->status] }}</td>
                            <td>{{ date("F j, Y, g:i a", strtotime($row['created_at'])) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot  style="min-height: 15rem;">
                    <td colspan="4">{{ $orders->links() }}</td>
                </tfoot>
            @else
                <tbody>
                    <tr>
                        <td class="bg-danger-subtle" colspan="4">You haven't made any orders yet.</td>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>
</div>

<script>
$(document).ready(() => {
    $('table tbody tr').click( (e) => {
        const tr_target = $(e.target).parent()
        const order_id = tr_target.attr('data-id')
        location.href = `/shop/order/${order_id}/view`
    })
})
</script>