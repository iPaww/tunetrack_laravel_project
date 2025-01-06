<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Query\Builder as QBuilder;
use Illuminate\Database\Eloquent\Builder as EBuilder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Colors;
use App\Models\InventoryProducts;
use App\Models\InventorySupplies;
use App\Models\Products;

use App\Http\Controllers\AdminControllers\BasePageController;

class InventoryController extends BasePageController
{
    public string $base_file_path = 'inventory.';

    public function index()
    {
        $products = Products::select(
                'products.*',
                'inv_sup.quantity',
                Products::raw('inv_sup.id as inventory_id'),
                Products::raw('colors.id as color_id'),
                Products::raw('colors.name as color_name'),
                Products::raw('GROUP_CONCAT(colors.name) as color_names'),
                Products::raw('COUNT(inv_prod.product_id) as products_quantity'),
            )
            ->leftJoin('inventory_supplies as inv_sup', 'inv_sup.product_id', '=', 'products.id' )
            ->leftJoin('inventory_products as inv_prod', 'inv_prod.product_id', '=', 'products.id' )
            ->leftJoin('colors', function (JoinClause $join) {
                $join->on('colors.id', '=', 'inv_sup.color_id')
                    ->orOn('colors.id', '=', 'inv_prod.color_id');
            })
            ->where(function (EBuilder $query) {
                return $query->where(function (QBuilder $query) {
                    return $query->select(InventoryProducts::raw('COUNT(id) as count'))
                    ->from('inventory_products')
                    ->where('taken', false)
                    ->whereColumn('product_id', 'inv_prod.product_id');
                }, '>', 0)
                ->orWhereColumn('products.id', '=', 'inv_sup.product_id');
            })
            ->where(function (EBuilder $query) {
                return $query->where('inv_prod.taken', false)
                    ->orWhereColumn('products.id', '=', 'inv_sup.product_id');
            })
            ->groupBy('products.id', 'inv_sup.id')
            ->orderBy('products.product_type_id')
            ->orderBy('products.name')
            ->paginate(10);
        return $this->view_basic_page( $this->base_file_path . 'index', compact( 'products' ));
    }

    public function add()
    {
        $products = Products::select('products.*')
            // ->leftJoin('inventory_supplies', 'inventory_supplies.product_id', '=', 'products.id' )
            // ->leftJoin('inventory_products', 'inventory_products.product_id', '=', 'products.id' )
            // ->leftJoin('colors', function (JoinClause $join) {
            //     $join->on('colors.id', '=', 'inventory_supplies.color_id')
            //         ->orOn('colors.id', '=', 'inventory_products.color_id');
            // })
            // ->whereNot(function (EBuilder $query) {
            //         $query->whereExists(function (QBuilder $query) {
            //             $query->select(Products::raw(1))
            //                 ->from('inventory_supplies')
            //                 ->whereColumn('inventory_supplies.product_id', 'products.id');
            //         });
            //     })
            ->whereNot(function (EBuilder $query) {
                    $query->whereExists(function (QBuilder $query) {
                        $query->select(Products::raw(1))
                            ->from('inventory_products')
                            ->where('taken', false)
                            ->whereColumn('inventory_products.product_id', 'products.id');
                    });
                })
            // ->where(function (EBuilder $query) {
            //     return $query->where('inv_prod.taken', false)
            //         ->orWhereColumn('products.id', '=', 'inv_sup.product_id');
            // })
            ->orderBy('product_type_id')
            ->orderBy('name')
            // ->groupBy('products.id')
            ->get();
        $colors = Colors::orderBy('name')
            ->get();
        return $this->view_basic_page( $this->base_file_path . 'create', compact( 'products', 'colors' ));
    }

    public function add_form(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required|numeric',
            'product_type' => 'required|numeric',
            'color' => 'exclude_if:product_type,1|required|numeric',
            'quantity' => 'exclude_if:product_type,1|required|numeric|min:1',
            'instrument_color' => 'exclude_if:product_type,2|required|array',
            'instrument_color.*' => 'exclude_if:product_type,2|required|numeric',
            'insturment_serial_number' => 'exclude_if:product_type,2|required|array',
            'insturment_serial_number.*' => 'exclude_if:product_type,2|required|alpha_num|distinct|unique:App\Models\InventoryProducts,serial_number',
        ], [
            'color.required' => 'Product color is required!',
            'quantity.required' => 'Quantity is required!',
            'instrument_color.*.required' => 'Color for input #:position is required!',
            'insturment_serial_number.*.required' => 'Serial Number for input #:position is required!',
            'insturment_serial_number.*.distinct' => 'Serial Number for input #:position should be unique!',
            'insturment_serial_number.*.unique' => 'Serial Number for input #:position already exist in our database!',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $product_id = $request->post('product');

        if( $request->post('product_type') == 1 ) {
            $color_arr = $request->post('instrument_color');
            foreach( $request->post('insturment_serial_number') as $index => $serial_number ) {
                // Validate if product already has inventory
                if( InventoryProducts::where([ 'product_id' => $product_id ])->exists() ) {
                    return back()
                        ->withErrors('Product already has inventory')
                        ->withInput();
                }
                InventoryProducts::create([
                    'serial_number' => $serial_number,
                    'taken' => false,
                    'product_id' => $product_id,
                    'color_id' => $color_arr[$index],
                ]);
            }
            
        } else if ( $request->post('product_type') == 2 ) {
            $color_id = $request->post('color');
            $quantity = $request->post('quantity');
            // Validate if product already has inventory
            if( InventorySupplies::where([ 'product_id' => $product_id, 'color_id' => $color_id ])->exists() ) {
                return back()
                    ->withErrors('Supply already has inventory with this color')
                    ->withInput();
            }
            InventorySupplies::create([
                'product_id' => $product_id,
                'color_id' => $color_id,
                'quantity' => $quantity,
            ]);
        }
        
        return redirect('/admin/inventory');
    }

    public function edit_products($product_id, $color_id)
    {
        $inventory = InventoryProducts::where('product_id', $product_id)
            ->first();
        $inventories = InventoryProducts::where('product_id', $product_id)
            ->get();
        $colors = Colors::orderBy('name')
            ->get();
        return $this->view_basic_page( $this->base_file_path . 'edit_product', compact( 'inventory', 'inventories', 'colors' ));
    }

    public function edit_supplies($product_id, $color_id)
    {
        $inventory = InventorySupplies::where('product_id', $product_id)
            ->where('color_id', $color_id)
            ->first();
        $colors = Colors::orderBy('name')
            ->get();
        return $this->view_basic_page( $this->base_file_path . 'edit_supply', compact( 'inventory', 'colors' ));
    }

    public function edit_form_products($product_id, $color_id, Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'inventory_id' => 'array',
            'inventory_id.*' => 'numeric|nullable',
            'instrument_color' => 'required|array',
            'instrument_color.*' => 'required|numeric',
            'insturment_serial_number' => 'required|array',
            'insturment_serial_number.*' => Rule::forEach(function ($value, string $attribute) use (&$product_id) {
                    return [
                        'required',
                        'alpha_num',
                        'distinct',
                        Rule::unique('inventory_products', 'serial_number')->whereNot('product_id', $product_id)
                    ];
                }),
            'delete_serials' => 'array',
            'delete_serials.*' => 'numeric',
        ], [
            'instrument_color.*.required' => 'Color for input #:position is required!',
            'insturment_serial_number.*.required' => 'Serial Number for input #:position is required!',
            'insturment_serial_number.*.distinct' => 'Serial Number for input #:position should be unique!',
            'insturment_serial_number.*.unique' => 'Serial Number for input #:position value of :input already exist in our database!',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $serial_arr = $request->post('insturment_serial_number');
        $color_arr = $request->post('instrument_color');
        $delete_inventories = $request->post('delete_serials');
        foreach( $request->post('inventory_id') as $index => $inventory_id ) {
            $serial_number = $serial_arr[$index];
            $color = $color_arr[$index];
            if( empty( $inventory_id ) ) {
                InventoryProducts::create([
                    'serial_number' => $serial_number,
                    'taken' => false,
                    'product_id' => $product_id,
                    'color_id' => $color_arr[$index],
                ]);
            } else {
                InventoryProducts::where('id', $inventory_id)
                    ->update([
                        'serial_number' => $serial_number,
                        'color_id' => $color_arr[$index],
                    ]);
            }
        }
        InventoryProducts::whereIn('id', $delete_inventories)
            ->delete();
        
        return redirect('/admin/inventory');
    }

    public function edit_form_supplies($product_id, $color_id, Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'color' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
        ], [
            'color.required' => 'Product color is required!',
            'quantity.required' => 'Quantity is required!',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $color_id_txt = $request->post('color');
        $quantity_txt = $request->post('quantity');

        if(
            $color_id_txt != $color_id && 
            InventorySupplies::where('product_id', $product_id)
                ->where('color_id', $color_id_txt)
                ->exists()
        ) {
            return back()
                ->withErrors('Supply already has inventory with this color')
                ->withInput();
        }

        InventorySupplies::where('product_id', $product_id)
            ->where('color_id', $color_id)
            ->update([
                'color_id' => $color_id_txt,
                'quantity' => $quantity_txt,
            ]);
        
        return redirect('/admin/inventory');
    }

    public function delete($product_id, $product_type_id, $color_id): RedirectResponse
    {
        if( $product_type_id == 1 ) {
            InventoryProducts::where('product_id', $product_id)
                ->delete();
        } else if ( $product_type_id == 2 ) {
            InventorySupplies::where('product_id', $product_id)
                ->where('color_id', $color_id)
                ->delete();
        }
        
        return back()
            ->with(['data' => ['Inventory item successfully removed!']]);
    }
}
