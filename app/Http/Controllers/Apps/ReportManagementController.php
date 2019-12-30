<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Sale;
use iteos\Models\Inventory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ReportManagementController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Can Access Report');
        $this->middleware('permission:Can Create Report', ['only' => ['create','store']]);
    }

    /*----Sales Reports--------------------*/
    public function saleTable()
    {
        return view('apps.pages.saleTable');
    }

    public function reportSales(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $data = Sale::where('updated_at','>=',$request->input('from_date'))
                        ->where('updated_at','<=',$request->input('to_date'))
                        ->get();
        
        return view('apps.show.saleTable',compact('data'));
    }

    public function inventoryTable()
    {
        return view('apps.pages.inventoryTable');
    }

    public function reportInventory(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $data = Inventory::join('inventory_movements','inventory_movements.inventory_id','inventories.id')
                    ->where('inventories.updated_at','>=',$request->input('from_date'))
                    ->where('inventories.updated_at','<=',$request->input('to_date'))
                    ->groupBy('inventories.product_id','inventories.warehouse_id')
                    ->selectRaw('sum(inventory_movements.incoming) as open,sum(inventory_movements.outgoing) as close,sum(inventory_movements.incoming) as incoming,sum(inventory_movements.outgoing) as outgoing,
                    sum(inventory_movements.remaining) as remaning,inventories.product_id,inventories.warehouse_id')
                    ->get();
        
        return view('apps.show.inventoryTable',compact('data'));
    }

    public function purchaseTable()
    {
        return view('apps.pages.purchaseTable');
    }
}
