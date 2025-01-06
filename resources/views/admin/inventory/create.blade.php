<?php
use Illuminate\Support\Collection;
?>
<div class="container">
    <h1>Create Inventory</h1>
    <form action="/admin/inventory/add" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">Products</label>
            <input type="hidden" name="product" required/>
            <input type="hidden" name="product_type" required/>
            <select class="product-select form-select" required>
                <option selected disabled>Select a product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}:::{{ $product->product_type_id }}" @selected($product->id == old('product'))>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        
        <?php
            $instrument_colors = old('instrument_color', []);
            $old_serials = collect(old('insturment_serial_number', []))->map(function ($item, int $key) use (&$instrument_colors) {
                return [ $item, $instrument_colors[$key] ];
            });
        ?>
        <div class="instruments-form-container" style="display: none;">
            @foreach( $old_serials as [$serial, $color] )
                <div class="input-group mb-3">
                    <div class="place-holder-for-input" data-old-value="{{ $serial }}"></div>
                    <div class="place-holder-for-select" data-old-value="{{ $color }}"></div>
                    <button type="button" class="btn btn-outline-primary btn-add-group">+</button>
                </div>
            @endforeach
        </div>

        <div class="supplies-form-container" style="display: none;">
            <div class="mb-3">
                <label for="sub_category_id" class="form-label">Colors</label>
                <select name="color" class="form-select">
                    <option selected disabled>Select a color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}" @selected($color->id == old('color'))>{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" min="1" max="99999">
            </div>
        </div>

        <div>
            @if ($errors->any())
            <ul class="list-group my-2">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            @if (session()->get('data'))
            <ul class="list-group my-2">
                @foreach (session()->get('data') as $data)
                    <li class="list-group-item list-group-item-success">{{ $data }}</li>
                @endforeach
            </ul>
            @endif
        </div>

        <!-- Back Button -->
        <div class="d-flex justify-content-between">
            <a href="/admin/inventory" class="btn btn-secondary">Back</a>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<div class="select-color-template d-none">
    <input type="hidden" name="instrument_color[]" />
    <select class="instrument-color-select form-select">
        <option selected disabled>Select a color</option>
        @foreach ($colors as $color)
            <option value="{{ $color->id }}">{{ $color->name }}</option>
        @endforeach
    </select>
</div>

<div class="input-serial-number-template d-none">
    <input name="insturment_serial_number[]" class="instrument-serial-input form-control" placeholder="Serial Number">
</div>

<div class="input-group-last-one-template d-none">
    <div class="input-group mb-3">
        <div class="place-holder-for-input"></div>
        <div class="place-holder-for-select"></div>
        <button type="button" class="btn btn-outline-primary btn-add-group">+</button>
    </div>
</div>

<div class="input-group-last-template d-none">
        <div class="input-group mb-3">
            <div class="place-holder-for-input"></div>
            <div class="place-holder-for-select"></div>
            <button type="button" class="btn btn-outline-danger btn-remove-group">-</button>
            <button type="button" class="btn btn-outline-primary btn-add-group">+</button>
        </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
    const product_select = $('select.product-select')
    product_select.change((e) => {
        const prodctSlctjQry = $(e.target)
        const [productId = null, productType = null] = (prodctSlctjQry.val() || '').split(':::')
        $('input[name="product"]').val( productId )
        $('input[name="product_type"]').val( productType )
        if ( productType == 1 ) {
            $('.instruments-form-container').show().trigger('change-button')
            $('.supplies-form-container').hide()
        } else if ( productType == 2 ) {
            $('.supplies-form-container').show()
            $('.instruments-form-container').hide()
        }
    })
    product_select.trigger('change')

    const instrument_form_container = $('.instruments-form-container')
    const last_input_group_template = $('.input-group-last-one-template :first-child').first()
    const new_input_group_template = $('.input-group-last-template :first-child').first()
    const select_color_template = $('.select-color-template').children()
    const input_serial_number_template = $('.input-serial-number-template :first-child').first()

    function replace_holders(placeholder_input, placeholder_select) {
        const serial_old_val = placeholder_input.data('old-value')
        const color_old_val = placeholder_select.data('old-value')
        const input_template = input_serial_number_template.clone()
        const select_template = select_color_template.clone()
        placeholder_input.replaceWith( input_template )
        placeholder_select.replaceWith( select_template )
        
        serial_old_val && $('.instrument-serial-input', input_template.parent()).val( serial_old_val ).trigger('change')
        color_old_val && $('input[name="instrument_color[]"]', select_template.parent()).val( color_old_val )
        color_old_val && $('.instrument-color-select', select_template.parent()).val( color_old_val )
    }

    instrument_form_container.on('change-button', (e) => {
        const container = $(e.target)
        if( container.children().length == 0 ) {
            const group_template = last_input_group_template.clone();
            replace_holders(
                $('.place-holder-for-input', group_template),
                $('.place-holder-for-select', group_template)
            )
            instrument_form_container.append( group_template )
        } else if ( container.children().length == 1 ) {
            const input_group = $('.input-group', instrument_form_container)
            replace_holders(
                $('.place-holder-for-input', input_group),
                $('.place-holder-for-select', input_group)
            )
            $('.btn-add-group', input_group).remove()
            $('.btn-remove-group', input_group).remove()
            input_group.append( $('.btn-add-group', new_input_group_template).clone() )
        } else {
            $('.input-group', container).each((index, e) => {
                const input_group = $(e);
                replace_holders(
                    $('.place-holder-for-input', input_group),
                    $('.place-holder-for-select', input_group)
                )
                $('.btn-add-group', input_group).remove()
                $('.btn-remove-group', input_group).remove()
                input_group.append( $('.btn-remove-group', new_input_group_template).clone() )
            })
            const last_input_group = $('.input-group:last-child', container).first()
            $('.btn-remove-group', last_input_group).remove()
            $('.btn-add-group', last_input_group).remove()
            last_input_group.append( $('.btn-remove-group', new_input_group_template).clone() )
            last_input_group.append( $('.btn-add-group', new_input_group_template).clone() )
        }
    });

    instrument_form_container.trigger('change-button')

    $(document).on('click', '.btn-remove-group', (e) => {
        const input_group = $(e.target)
        input_group.parent().remove()
        instrument_form_container.trigger('change-button')
    });

    $(document).on('click', '.btn-add-group', function() {
        const group_template = new_input_group_template.clone();
        $('.place-holder-for-select', group_template).replaceWith( select_color_template.clone() )
        $('.place-holder-for-input', group_template).replaceWith( input_serial_number_template.clone() )
        instrument_form_container.append( group_template )
        instrument_form_container.trigger('change-button')
    });

    $(document).on('change', '.instrument-color-select', (e) => {
        const select = $(e.target)
        const input = select.prev()
        input.val( select.val() )
    })
})
</script>