<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShippingCompanyRequest;
use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        if (!Auth::user()->ability('admin', 'manage_shipping_companies,show_shipping_companies')){
            return redirect('admin/index');
        }

        $shipping_companies = ShippingCompany::withCount('countries')
            ->when(\request()->keyword != '', function ($q){
                $q->search(\request()->keyword);
            })
            ->when(\request()->status != '', function ($q){
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.shipping_companies.index', compact('shipping_companies'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {
        if (!Auth::user()->ability('admin', 'create_shipping_companies')){
            return redirect('admin/index');
        }
        $countries = Country::orderBy('id', 'asc')->get(['id', 'name']);
        return view('backend.shipping_companies.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(ShippingCompanyRequest $request)
    {
        if (!Auth::user()->ability('admin', 'create_shipping_companies')){
            return redirect('admin/index');
        }

        if ($request->validated()) {
            $shipping_company = ShippingCompany::create($request->except('countries', '_token', 'submit'));
            $shipping_company->countries()->attach(array_values($request->countries));

            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Created successfully',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Something wrong',
                'alert-type' => 'danger'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingCompany $shipping_company)
    {
        if (!Auth::user()->ability('admin', 'update_shipping_companies')){
            return redirect('admin/index');
        }

        $shipping_company->with('countries');
        $countries = Country::get(['id', 'name']);
        return view('backend.shipping_companies.edit', compact('shipping_company', 'countries'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingCompanyRequest $request, ShippingCompany $shipping_company)
    {
        if (!Auth::user()->ability('admin', 'update_shipping_companies')){
            return redirect('admin/index');
        }


        if ($request->validated()) {

            $shipping_company->update($request->except('countries', '_token', 'submit'));
            $shipping_company->countries()->sync(array_values($request->countries));

            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Updated successfully',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Something wrong',
                'alert-type' => 'danger'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(ShippingCompany $shipping_company)
    {
        if (!Auth::user()->ability('admin', 'delete_shipping_companies')){
            return redirect('admin/index');
        }
        $shipping_company->delete();

        return redirect()->route('admin.shipping_companies.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
