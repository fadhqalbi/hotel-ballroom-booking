<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer, Request $request)
    {
        $customers = DB::table('customer');
        if( !is_null($request->query('search')))
        {
            $customers = $customer->where('nama_customer','like','%'.$request->query('search').'%');
        }
        $customers = $customers->paginate(10);
        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Customer $customer, )
    {
        $customers = DB::table('customer');
        $alpha = substr($request->nama_customer, 0, 1);
        $last = $customer->where('nama_customer','like',$alpha.'%')->get()->last();
        if( !is_null($last))
        {
            $lastnum = substr($last->no_customer, -4);
            $newnum = sprintf('%04d', $lastnum+1);
        }
        else{
            $newnum = '0001';
        }
        $no_customer = 'C'.$alpha.$newnum;

        $request->validate([
            'nama_customer' => 'required|max:250',
            'alamat' => 'required|max:250',
            'kota' => 'required|max:50',
            'email' => 'required|email:dns',
            'hp' => 'required|max:12',       
        ]);
        try{
            DB::beginTransaction();
            Customer::create([
                'no_customer' => $no_customer,
                'nama_customer' => $request->input('nama_customer'),
                'alamat' => $request->input('alamat'),
                'kota' => $request->input('kota'),
                'email' => $request->input('email'),
                'hp' => $request->input('hp')
            ]);
            DB::commit();
            $result = [
                'status' => 'success',
                'message' => 'New customer has been added!'
            ];
        }
        catch(Exception $e){
            DB::rollBack();
            $result = [
                'status' => 'error',
                'message' => 'Failed to add new customer!'
            ];
        }
        return redirect()->route('customer.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit',[
            'customer' => $customer,
            'customers' => Customer::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'nama_customer' => 'required|max:250',
            'alamat' => 'required|max:250',
            'kota' => 'required|max:50',
            'email' => 'required|email:dns',
            'hp' => 'required|max:12',     
        ];
        if($request->no_customer != $customer->no_customer){
            $rules['no_customer'] = 'required|unique:customer|size:6';
        }
        $validatedData = $request->validate($rules);

        Customer::where('no_customer', $customer->no_customer)->update($validatedData);

        return redirect()->route('customer.index')->with('success','Customer data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try{
            DB::beginTransaction();
            $customer->delete();
            DB::commit();
            $result=[
                'status' => 'success',
                'message' => 'Customer data has been deleted!'
            ];
        }catch(Exception $e){
            $result=[
                'status' => 'error',
                'message' => 'Failed to delete customer record!'
            ];
        }
        return redirect()->route('customer.index')->with($result);
    }
}
