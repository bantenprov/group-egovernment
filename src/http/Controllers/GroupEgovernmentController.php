<?php

namespace Bantenprov\GroupEgovernment\Http\Controllers;

use Bantenprov\GroupEgovernment\Models\Bantenprov\GroupEgovernment\GroupEgovernment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

/**
 * The GroupEgovernmentController class.
 *
 * @package Bantenprov\GroupEgovernment
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class GroupEgovernmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);

            $query = GroupEgovernment::orderBy($sortCol, $sortDir);
        } else {
            $query = GroupEgovernment::orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('label', 'like', $value)
                    ->orWhere('description', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $response = $query->paginate($perPage);

        return response()->json($response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group_egovernment = new GroupEgovernment;

        $response['group_egovernment'] = $group_egovernment;
        $response['status'] = true;

        return response()->json($group_egovernment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupEgovernment  $group_egovernment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group_egovernment = new GroupEgovernment;

        $this->validate($request, [
            'label' => 'required|max:16',
            'description' => 'max:255',
        ]);

        $group_egovernment->label = $request->get('label');
        $group_egovernment->description = $request->get('description');
        $group_egovernment->save();

        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group_egovernment = GroupEgovernment::findOrFail($id);

        $response['group_egovernment'] = $group_egovernment;
        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupEgovernment  $group_egovernment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group_egovernment = GroupEgovernment::findOrFail($id);

        $response['group_egovernment'] = $group_egovernment;
        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupEgovernment  $group_egovernment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group_egovernment = GroupEgovernment::findOrFail($id);

        if($request->get('old_label') == $request->get('label'))
        {
            $validator = Validator::make($request->all(), [
                'label' => 'required|max:16',
                'description' => 'max:255',
            ]);

        }else{
            $validator = Validator::make($request->all(), [
                'label' => 'required|max:16|unique:group_egovernments,label',
                'description' => 'max:255',
            ]);
        }


        if($validator->fails()){
            $response['message'] = 'Failed, label ' . $request->label . ' already exists';
        }else{
            $response['message'] = 'success';
            $group_egovernment->label = $request->get('label');
            $group_egovernment->description = $request->get('description');
            $group_egovernment->save();
        }



        $response['status'] = true;


        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupEgovernment  $group_egovernment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group_egovernment = GroupEgovernment::findOrFail($id);

        if ($group_egovernment->delete()) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        return json_encode($response);
    }
}

