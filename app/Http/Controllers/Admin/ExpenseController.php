<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Expense;
use App\User;
use App\warehouse\WarehouseModel;
use App\ExpenseCategory;
use RealRashid\SweetAlert\Facades\Alert;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all_expenseCategory = ExpenseCategory::all();
        $all_user = User::all();
        $all_warehouse = WarehouseModel::all();
        return view('admin/expense/expense', compact('all_expenseCategory', 'all_user', 'all_warehouse'));
    }
    //
    public function expenseListTable()
    {

        //$all_asset = AssetType::latest()->first();
        //return $all_asset;
        $all_expense = Expense::all();

        //echo $all_expense;
        //return $all_expense;
        return response()->json(['data' => $all_expense]);
    }
    //addExpenseList
    public function addExpenseList(Request $request)
    {
        $request->validate([
            'date'   => 'required',
            'reference'       => 'required',
            'warehouse' => 'required',
            'category'   => 'required',
            'amount'       => 'required',
        ]);

        Expense::create([
            'date'   => $request->date,
            'reference'       => $request->reference,
            'warehouse' => $request->warehouse,
            'category'   => $request->category,
            'amount'       => $request->amount,
            'note' => $request->note
        ]);

        return response()->json('success');
    }
    //
    public function editExpenseList($id)
    {
        $data = Expense::find($id);
        return [
            'date'   => $data->date,
            'reference'       => $data->reference,
            'warehouse' => $data->warehouse,
            'category'   => $data->category,
            'amount'       => $data->amount,
            'note' => $data->note
        ];
    }
    //
    public function updateExpenseList(Request $request, $id)
    {
        $request->validate([
            'date'   => 'required',
            'reference'       => 'required',
            'warehouse' => 'required',
            'category'   => 'required',
            'amount'       => 'required',
        ]);

        $edit_data = Expense::find($id);
        $edit_data->date = $request->date;
        $edit_data->reference = $request->reference;
        $edit_data->warehouse = $request->warehouse;
        $edit_data->category = $request->category;
        $edit_data->amount = $request->amount;
        $edit_data->note = $request->note;
        $edit_data->update();
        return response()->json('Updated');
    }
    //
    public function deleteExpenseList($id)
    {
        $data = Expense::find($id);
        $data->delete();
        return response()->json('success');
    }

    //
    public function expenseCategoryListTable()
    {

        //$all_asset = AssetType::latest()->first();
        //return $all_asset;
        $all_expenseCategory = ExpenseCategory::all();
        //echo $all_expense;
        //return $all_expense;
        return response()->json(['data' => $all_expenseCategory]);
    }
    //
    public function addExpenseCategoryList(Request $request)
    {
        $request->validate([
            'code'   => 'required | unique:expense_categories',
            'name'       => 'required | unique:expense_categories',
        ]);

        ExpenseCategory::create([
            'code'   => $request->code,
            'name'       => $request->name,
        ]);
        return response()->json('success');
    }

    //
    public function editExpenseCategoryList($id)
    {
        $data = ExpenseCategory::find($id);
        return [
            'code'   => $data->code,
            'name'       => $data->name,
        ];
    }
    //
    public function updateExpenseCategoryList(Request $request, $id)
    {
        $request->validate([
            'code'   => 'required',
            'name'       => 'required',
        ]);

        $edit_data = ExpenseCategory::find($id);
        $edit_data->code = $request->code;
        $edit_data->name = $request->name;
        $edit_data->update();
        return response()->json('Updated');
    }
    //
    public function deleteExpenseCategoryList($id)
    {
        $data = ExpenseCategory::find($id);
        $data->delete();
        return response()->json('success');
    }
















    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}