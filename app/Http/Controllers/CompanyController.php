<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use  App\Http\Requests\CompanyStoreRequest;
use  App\Http\Requests\CompanyUpdateRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return CompanyResource::collection(Company::paginate(10));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        //

        $newCompany =  New Company();
        $newCompany->name = $request->name;
        $newCompany->year_founded = $request->year_founded;
        $newCompany->street_address = $request->street_address;
        $newCompany->city = $request->city;
        $newCompany->state = $request->state;
        $newCompany->zip_code = $request->zip_code;
        $newCompany->country = $request->country;
        $newCompany->save();

        if($newCompany){
            return response()->json(['success'  =>  true, 'message' => 'New record added.', 'data' => $newCompany]);  

        }else{
            return response()->json(['success'  =>  false,  'message' => 'something went wrong! Could not save record', 'data' => []]);  

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
        return new CompanyResource(Company::findOrFail($id));
    }

    /**
     * Display contact collections of a specified company resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function contacts($id)
    {
        //
        return ContactResource::collection(Contact::where('company_id', $id)->paginate(10));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
        //
        $updateCompany = Company::findorFail($id);
        
        $updateCompany->name = $request->name;
        $updateCompany->year_founded = $request->year_founded;
        $updateCompany->street_address = $request->street_address;
        $updateCompany->city = $request->city;
        $updateCompany->state = $request->state;
        $updateCompany->zip_code = $request->zip_code;
        $updateCompany->country = $request->country;
        $updateCompany->update();

        if($updateCompany){
            return response()->json(['success'  =>  true, 'message' => 'Record updated.']);  

        }else{
            return response()->json(['success'  =>  false,  'message' => 'something went wrong! Could not save record', 'data' => []]);  

        }
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
