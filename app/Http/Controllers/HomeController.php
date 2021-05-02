<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\GiveAnswer;
use App\Answer;
use App\User;
use App\Employee;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Redirect;
use Auth;
use Hash;
use App\warehouse\WarehouseModel;
use App\Customer;
use App\supplier;
use App\Purchase;
use App\Sale;
use App\Expense;
use App\Product_sale;
use App\Product;
use App\Payment;


use RealRashid\SweetAlert\Facades\Alert;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }


    public function home()
    {
        $get_questions = Question::orderBy('id', 'asc')->where('status', 1)->paginate(15);
        $get_answer = GiveAnswer::all();
        $total_users = User::where('role', 0)->count();
        $total_question = Question::count();
        $total_answers = Answer::count();
        $get_user = Auth::user();

        $total_customer = Customer::count();
        $total_warehouse = WarehouseModel::count();
        $total_supplier = supplier::count();

        $date = \Carbon\Carbon::today();
        $today_sale = Sale::where('updated_at', '>=', $date)->sum('total_price');
        $today_purchase = Purchase::where('updated_at', '>=', $date)->sum('total_cost');
        $today_expense = Expense::where('updated_at', '>=', $date)->sum('amount');
        $today_revenue = $today_sale;
        $today_profite = $today_revenue - ($today_purchase + $today_expense);

        $date = \Carbon\Carbon::today()->subDays(7);
        $weekly_sale = Sale::where('updated_at', '>=', $date)->sum('total_price');
        $weekly_purchase = Purchase::where('updated_at', '>=', $date)->sum('total_cost');
        $weekly_expense = Expense::where('updated_at', '>=', $date)->sum('amount');
        $weekly_revenue = $weekly_sale;
        $weekly_profite = $weekly_revenue - ($weekly_purchase + $weekly_expense);

        
        $monthly_sale = Sale::whereMonth('updated_at', date('m'))->sum('total_price');
        $monthly_purchase = Purchase::whereMonth('updated_at',  date('m'))->sum('total_cost');
        $monthly_expense = Expense::whereMonth('updated_at',  date('m'))->sum('amount');
        $monthly_revenue = $monthly_sale;
        $monthly_profite = $monthly_revenue - ($monthly_purchase + $monthly_expense);

       /*  User::whereMonth('updated_at', )
->whereYear('updated_at', date('Y'))
->get(['name','updated_at']); */

        $yearly_sale = Sale::whereYear('updated_at', date('Y'))->sum('total_price');
        $yearly_purchase = Purchase::whereYear('updated_at', date('Y'))->sum('total_cost');
        $yearly_expense = Expense::whereYear('updated_at', date('Y'))->sum('amount');
        $yearly_revenue = $yearly_sale;
        $yearly_profite = $yearly_revenue - ($yearly_purchase + $yearly_expense);


        $today = ['revenue' => $today_revenue, 'profit' => $today_profite , 'expense' =>$today_expense,'purchase'=>$today_purchase];
        $week = ['revenue' => $weekly_revenue, 'profit' => $weekly_profite, 'expense' =>$weekly_expense,'purchase'=>$weekly_purchase];
        $month = ['revenue' => $monthly_revenue, 'profit' => $monthly_profite, 'expense' =>$monthly_expense,'purchase'=>$monthly_purchase];
        $year = ['revenue' => $weekly_revenue, 'profit' => $weekly_profite, 'expense' =>$yearly_expense,'purchase'=>$yearly_purchase];

        $all_data=[];

        array_push($all_data,$today);
        array_push($all_data,$week);
        array_push($all_data,$month);
        array_push($all_data,$year);

        $purchase_byMonths=[];
        $sale_byMonths=[];
        for ($i=0; $i < 13; $i++) { 
            array_push($purchase_byMonths, Purchase::whereMonth('updated_at',  $i)->sum('total_cost'));
            array_push($sale_byMonths, Sale::whereMonth('updated_at',  $i)->sum('total_price'));
        }  
        
        $best_sells=Product_sale::whereYear('updated_at', date('Y'))->groupBy('product_id')->selectRaw('*, sum(qty) ')->orderBy('sum(qty)', 'desc')->limit(5)->get();;
        
        foreach ($best_sells as $sell) {
            $sell['sum_qty']=$sell['sum(qty)'];
            $product=Product::find($sell->product_id);
            $sell['product_name']= $product->name;
            $sell['barcode_symbology']= $product->barcode_symbology;
        }

        $best_sells_byprice=Product_sale::whereYear('updated_at', date('Y'))->groupBy('product_id')->selectRaw('*, sum(total) ')->orderBy('sum(total)', 'desc')->limit(5)->get();;
        
        foreach ($best_sells_byprice as $best_sell_byprice) {
            $best_sell_byprice['sum_price']=$best_sell_byprice['sum(total)'];
            $product=Product::find($best_sell_byprice->product_id);
            $best_sell_byprice['product_name']= $product->name;
            $best_sell_byprice['barcode_symbology']= $product->barcode_symbology;
        }

        $sales = Sale::orderBy('updated_at', 'desc')->limit(5)->get();

        foreach ($sales as $sale) {
            $customer = Customer::Find($sale->Customer_id);
            $sale->customer_name = $customer->name;
        }

        $purchases = Purchase::orderBy('updated_at', 'desc')->limit(5)->get();

        foreach ($purchases as $purchase) {
            $supplier = supplier::Find($purchase->supplier_id);
            $purchase->supplier_name = $supplier->name;
        }

        $payments = Payment::orderBy('updated_at', 'desc')->limit(5)->get();
        
        return view('dashboardTemp', compact('total_customer', 'total_warehouse', 'total_supplier', 'get_user'), ['all_data' => $all_data,'sale_byMonths' => $sale_byMonths,'purchase_byMonths' => $purchase_byMonths,'best_sells' => $best_sells,'best_sells_byprice' => $best_sells_byprice,'sales' => $sales ,'purchases' => $purchases,'payments' => $payments ]);
    }
    public function users()
    {
        //$all_users = User::where('role', 0)->orderBy('id', 'asc')->paginate(10);
        $all_admin = User::where('role', 1)->orderBy('id', 'asc')->paginate(5);
        $all_owner = User::where('role', 2)->orderBy('id', 'asc')->paginate(5);
        $all_employee = User::where('role', 3)->orderBy('id', 'asc')->paginate(5);

        //return view('admin.users.all_users', compact('all_users', 'all_admin'));
        return view('admin.users.userList', compact('all_owner', 'all_admin', 'all_employee'));
    }
    public function user_delete($user_id)
    {
        User::find($user_id)->delete();
        return back()->with('delete_success', 'User Delete Successfully');
    }
    public function user_edit($user_id)
    {
        $get_user = User::find($user_id);
        return view('admin.users.userEdit', compact('get_user'));
    }
    public function edit_user_post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'status' => 'required'
        ], [
            'name.required' => 'Enter User Name',
            'email.required' => 'Enter User Email',
        ]);
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);

        if ($request->status == 1) {
            Employee::updateOrCreate([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }












        //Alert::success('Success Title', 'Success Message');
        return Redirect::to('users')->with('edit_successs', 'User Information Update Successfully');
    }
    public function editprofile()
    {
        return view('admin.profile.editprofile');
    }
    public function editprofilepost(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ], [
            'old_password.required' => 'Please field your old password',
            'password.required' => 'Enter your new password',
            'password_confirmation.required' => 'Enter your confirm password',
        ]);
        $old_password = $request->old_password;
        $db_password = Auth::user()->password;
        if (Hash::check($old_password, $db_password)) {
            User::find(Auth::id())->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->with('editsuccess', 'Password update Successfully');
        } else {
            return back()->with('editerror', 'Password does not match!');
        }
    }
}