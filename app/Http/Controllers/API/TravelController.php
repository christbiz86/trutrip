<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TravelController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $list = Travel::where('users_id',$user_id)->get();
//        $list = Travel::all();
        return $this->sendResponse(TravelResource::collection($list), 'Travel fetched.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title'         => 'required',
            'origin'        => 'required',
            'destination'   => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
            'type'          => 'required',
            'description'   => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $input['users_id'] = $request->user()->id;
        $travel = Travel::create($input);
        return $this->sendResponse(new TravelResource($travel), 'Travel created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user_id = $request->user()->id;
        $list = Travel::where('users_id',$user_id)->where('id',$id)->get();
        if($list){
            return $this->sendResponse(TravelResource::collection($list), 'Travel fetched.');
        } else {
            return $this->sendError('Travel not found!', ['error'=>'Wrong token or Travel ID not found!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = $request->user()->id;
        $input = $request->all();
        $validator = Validator::make($input, [
            'title'         => 'required',
            'origin'        => 'required',
            'destination'   => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
            'type'          => 'required',
            'description'   => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $travel = Travel::where('users_id',$user_id)->where('id',$id)->first();
        if($travel){
            $travel->title = $input['title'];
            $travel->origin = $input['origin'];
            $travel->destination = $input['destination'];
            $travel->start_date = $input['start_date'];
            $travel->end_date = $input['end_date'];
            $travel->type = $input['type'];
            $travel->description = $input['description'];
            $travel->save();
            return $this->sendResponse(new TravelResource($travel), 'Travel updated.');
        } else {
            return $this->sendError('Update failed!', ['error'=>'Wrong token or Travel ID not found!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user_id = $request->user()->id;
        $list = Travel::where('users_id',$user_id)->where('id',$id)->first();
        if($list){
            $list->delete();
            return $this->sendResponse([], 'Travel deleted.');
        } else {
            return $this->sendError('Delete failed!', ['error'=>'Wrong token or Travel ID not found!']);
        }
    }
}
