<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactNotes;

class ContactNoteController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
            return ContactNoteResource::collection(ContactNotes::paginate(10));
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
    
            $newNote =  New ContactNote();
            $newNote->contact_id = $request->contact_id;
            $newNote->note  = $request->note;
            $newNote->save();
    
            if($newNote){
                return response()->json(['success'  =>  true, 'message' => 'New recored added.', 'data' => $newNote]);  
    
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
            return new ContactNoteResource(ContactNote::findOrFail($id));
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
    
            $newNote =  ContactNote::find($request->id);
            $newNote->contact_id = $request->contact_id;
            $newNote->note  = $request->note;
            $newNote->update();
    
            if($newNote){
                return response()->json(['success'  =>  true, 'message' => 'record updated.']);  
    
            }else{
                return response()->json(['success'  =>  false,  'message' => 'something went wrong! Could not update record', 'data' => []]);  
    
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
