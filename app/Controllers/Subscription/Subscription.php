<?php

namespace App\Controllers\Connection;

use App\Controllers\BaseController;
use App\Models\AttachmentModel;
use App\Models\ConnectionModel;

class Connection extends BaseController
{
    public function __construct()
    {
    }

    /**
     * Display the subscription form
     */
    public function index($lang='fr')
    {
        helper(['form','url']);
        $title =  'Eneo Cameroon - New Connection Form';

        return view('subcription/subcription_form', compact('title'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // Perform effective validation
        //$this->customer->save_customer($request->all());
        //flash()->success(trans('subscription.subscription_success'));
        //return back();
    }


    public function confirm_subscription($activation_code)
    {
        $contract_number = base64_decode($activation_code);

        $customer = $this->customer->get_customer_by_contract_number($contract_number);

        if (isset($customer)) {
            // Activate customer subscription
            $this->customer->activate_customer_subscription($customer->id);
            flash()->success(trans('subscription.subscription_activation'));
            return redirect('/home');
        } else {
            abort(404);
        }
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