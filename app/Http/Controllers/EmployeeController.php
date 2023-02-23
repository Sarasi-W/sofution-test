<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreEmployee;
use App\Http\Requests\UpdateEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);

        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::orderBy('name', 'asc')->get();
        
        return view('employees.form', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        $data = $request->all();

        $employee = Employee::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'company_id' => $data['company'],
        ]);

        return redirect()->back()->with('success', 'The employee is successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $companies = Company::orderBy('name', 'asc')->get();
        
        return view('employees.edit', ['companies' => $companies, 'employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = Company::orderBy('name', 'asc')->get();
        
        return view('employees.edit', ['companies' => $companies, 'employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployee $request, Employee $employee)
    {
        $data = $request->all();

        $employee->first_name = $data['first_name'];
        $employee->last_name = $data['last_name'];
        $employee->phone = $data['phone'];
        $employee->email = $data['email'];
        $employee->company_id = $data['company'];

        $employee->save();
         
        return redirect()->back()->with('success', 'The employee is successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        
        return redirect()->back()->with('success', 'The employee is successfully deleted.');
    }

    /**
     * Display a listing of the resource after filtering.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $employees = Employee::where('first_name', 'Like','%'.request()->get('q').'%')
                            ->orWhere('last_name', 'Like','%'.request()->get('q').'%')
                            ->orWhere('email','Like','%'.request()->get('q').'%')
                            ->orWhere('phone','Like','%'.request()->get('q').'%')
                            ->orWhereHas('company', function($q) use ($request) {
                                $q->where('name', 'Like',$request->get('q').'%');
                            })
                            ->orderBy('id', 'desc')->paginate(10);

        return view('employees.index', ['employees' => $employees]);
    }
}