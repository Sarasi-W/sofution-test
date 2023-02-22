<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompany;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(10);
        
        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $data = $request->all();

        if ($data['logo']) {
            $logo = $this->storeImage($data['logo']);
        }

        $company = Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'logo' => $logo,
            'website' => $data['website'],
        ]);

        return redirect()->back()->with('success', 'The company is successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    public function storeImage($image)
    {
        $destinationPath = 'images/company_logos';
        $companyLogo = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $companyLogo);
        $input['image'] = "$companyLogo";

        return $companyLogo;
    }
}