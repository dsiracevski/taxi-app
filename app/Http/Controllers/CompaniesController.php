<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function view()
    {


        return view('admin.companies', [
            'companies' => Companies::all()
        ]);
    }

    public function show(Companies $company)
    {
        return view('admin.company', [
            'company' => $company
        ]);
    }


    public function create(Request $request)
    {

        $attributes = request()->validate([
            'name' => 'required'
        ]);

        Companies::create($attributes);

        return redirect(route('viewCompanies'))->with('success', 'Компанијата е додадена!');

    }

    public function update(Companies $company)
    {

        $attributes = request()->validate([
            'name' => 'required'
        ]);

        $company->update($attributes);

        return redirect(route('viewCompany', ['company' => $company]));
    }

    public function destroy(Companies $company)
    {

        $company->delete();

        return redirect(route('viewCompanies'));
    }
}
