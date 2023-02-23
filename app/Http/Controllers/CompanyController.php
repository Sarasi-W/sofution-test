<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\UpdateCompany;
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
        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany $request, Company $company)
    {
        $data = $request->all();

        if (isset($data['logo'])) {
            $logoToRemove = $company->logo;
            $company->logo = $this->storeImage($data['logo']);
            unlink('images/company_logos/'.$logoToRemove);
        }

        $company->name = $data['name'];
        $company->email = $data['email'];
        $company->website = $data['website'];

        $company->save();

        return redirect()->back()->with('success', 'The company is successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        foreach($company->employees as $employee) {
            $employee->delete();
        }
        $company->delete();
        
        return redirect()->back()->with('success', 'The company is successfully deleted with their employees.');
    }

    public function storeImage($image)
    {
        $destinationPath = 'images/company_logos';
        $companyLogo = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $companyLogo);
        $input['image'] = "$companyLogo";

        return $companyLogo;
    }

    /**
     * Display a listing of the resource after filtering.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $companies = Company::where('name', 'Like','%'.request()->get('q').'%')
                            ->orWhere('email','Like','%'.request()->get('q').'%')
                            ->orWhere('website','Like','%'.request()->get('q').'%')
                            ->orderBy('id', 'desc')->paginate(10);

        return view('companies.index', ['companies' => $companies]);
    }
}