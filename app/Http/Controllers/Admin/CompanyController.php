<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Company;
use App\Http\Requests\StoreCompany;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with('employees')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.companies', ['companies'=>$companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $image = $request->file('image');
        $imageName = time() . $image->getClientOriginalName();
        $imagePath = 'storage';

        Company::create([
            'name'=>$request->company_name,
            'email'=>$request->company_email,
            'logo'=> $imageName,
            'website'=>$request->company_site
        ]);
        $image->move($imagePath, $imageName);

        return redirect()->route('companies.index')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);

        return view('admin.company_show', ['company'=>$company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        return view('admin.company_edit', ['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompany $request, $id)
    {
        $company = Company::find($id);

        $company->name = $request->company_name;
        $company->email = $request->company_email;
        $company->website = $request->company_site;

        if($request->file('image')){
            $image = $request->file('image');
            unlink('storage/'.$company->logo);
            $imagePath = 'storage';
            $imageName = time() . $image->getClientOriginalName();
            $company->logo = $imageName;
            $image->move($imagePath, $imageName);
        }

        $company->save();

        return redirect()->route('companies.show', ['id'=>$company->id])->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedCompany = Company::find($id);
        unlink('storage/'.$deletedCompany->logo);
        $deletedCompany->delete();

        return back();
    }
}
