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

        return response()->json(
                $query->paginate($perPage)
            )
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
        return response()->json([
            'group_egovernment' => new GroupEgovernment,
        ]);
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

        return response()->json([
            'label' => $group_egovernment->label,
            'description' => $group_egovernment->description,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupEgovernment  $group_egovernment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return response()->json([
            'label' => $group_egovernment->label,
            'description' => $group_egovernment->description,
        ]);
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
        //
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
            $respond['status'] = true;
        } else {
            $respond['status'] = false;
        }

        return json_encode($respond);
    }
}

