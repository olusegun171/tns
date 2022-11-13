<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use  App\Http\Requests\ContactStoreRequest;
use  App\Http\Requests\ContactUpdateRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ContactResource::collection(Contact::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        //

        $newContact =  New Contact();
        $newContact->company_id = $request->company_id;
        $newContact->first_name  = $request->first_name;
        $newContact->last_name  = $request->last_name;
        $newContact->position  = $request->position;
        $newContact->email  = $request->email;
        $newContact->mobile_no  = $request->mobile_no;
        $newContact->save();

        if($newContact){
            return response()->json(['success'  =>  true, 'message' => 'New recored added.', 'data' => $newContact]);  

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
        return new ContactResource(Contact::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, $id)
    {
        //
        $updateContact =  Contact::findorFail($id);
        $updateContact->first_name  = $request->first_name;
        $updateContact->last_name  = $request->last_name;
        $updateContact->position  = $request->position;
        $updateContact->email  = $request->email;
        $updateContact->mobile_no  = $request->mobile_no;
        $updateContact->update();

        if($updateContact){
            return response()->json(['success'  =>  true, 'message' => 'Record updated.']);  

        }else{
            return response()->json(['success'  =>  false,  'message' => 'something went wrong! Could not update record', 'data' => []]);  

        }
    }

    /**
     * Search contacts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request  $request)
    {
        //
        if ($request->filled('keyword')) {
            
           return ContactResource::collection(Contact::where('first_name', 'LIKE', '%$request->keyword%')
                                                ->orWhere('last_name', 'LIKE', '%$request->keyword%')
                                                ->orWhereHas('company', function ($query) {
                                                            $query->where('name', 'like', '%$keyword%');
                                                })->get());
        }else{
            return response()->json(['success'  =>  false,  'message' => 'No keyword search', 'data'=>[]]);  
        }
    }
}
