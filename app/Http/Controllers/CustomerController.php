<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Customer::get();

        $groups = ["A","B","C"];

        $data = [
            'members'=>$members,
            'title'=>'Members',
            'groups'=>$groups,
        ];

        return view('members.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $groups = ["A","B","C"];

        $data = [
            'groups'=>$groups
        ];
        return view('members.craete')->with($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name'=>'required',
            'phone_number'=>'required',
            'group'=>'required',
        ];

        $this->validate($request,$rules);

        $saveCustomer = new Customer();

        $saveCustomer->name = $request->name;

        $saveCustomer->phone_number = $request->phone_number;

        $saveCustomer->group = $request->group;

        $saveCustomer->save();

        return redirect()->route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($group)
    {
        return Customer::where('group',$group)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($customer)
    {
        $customer = Customer::find($customer);
        
        $groups = ["A","B","C"];

        $data = [
            'member'=>$customer,  
            'groups'=>$groups     
        ];

        return view('members.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {
        $saveCustomer = Customer::find($customer);

        $saveCustomer->name = $request->name;

        $saveCustomer->phone_number = $request->phone_number;

        $saveCustomer->group = $request->group;

        $saveCustomer->save();

        return redirect()->route('members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer)
    {
        Customer::destroy($customer);

        return back();
    }

    public function send_message(Request $request)
    {

        $rules = [
            'compose_message'=>'required',
            'group'=>'required',
            'members'=>'required',
        ];

        $this->validate($request,$rules);

        foreach($request->members as $member){

            $member = Customer::find($member);

            $message = "Dear ".$member->name;

            $message .= '\n'.$request->compose_message;

            Customer::pushBulk_SMS($member->phone_number,$message);

        }

        return back();


    }
}
