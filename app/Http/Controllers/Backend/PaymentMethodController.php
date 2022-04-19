<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_payment_methods,show_payment_methods')) {
            return redirect('admin/index');
        }

        $payment_methods = PaymentMethod::query()
            ->when(\request()->keyword != '', function ($q) {
                $q->search(\request()->keyword);
            })
            ->when(\request()->status != '', function ($q) {
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.payment_methods.index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_payment_methods')) {
            return redirect('admin/index');
        }

        return view('backend.payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_payment_methods')) {
            return redirect('admin/index');
        }

        PaymentMethod::create($request->validated());

        return redirect()->route('admin.payment_methods.index')->with([
            'message'    => 'Created successfully',
            'alert-type' => 'success'
        ]);
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
    public function edit(PaymentMethod $payment_method)
    {
        if (!auth()->user()->ability('admin', 'update_payment_methods')) {
            return redirect('admin/index');
        }

        return view('backend.payment_methods.edit', compact('payment_method'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentMethodRequest $request, PaymentMethod $payment_method)
    {
        if (!auth()->user()->ability('admin', 'update_payment_methods')) {
            return redirect('admin/index');
        }

        $payment_method->update($request->validated());

        return redirect()->route('admin.payment_methods.index')->with([
            'message'    => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $payment_method)
    {
        if (!auth()->user()->ability('admin', 'delete_payment_methods')) {
            return redirect('admin/index');
        }

        $payment_method->delete();

        return redirect()->route('admin.payment_methods.index')->with([
            'message'    => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
