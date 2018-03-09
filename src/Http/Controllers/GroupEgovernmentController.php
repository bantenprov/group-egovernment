<?php

namespace Bantenprov\GroupEgovernment\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\BudgetAbsorption\Facades\GroupEgovernmentFacade;

/* Models */
use Bantenprov\GroupEgovernment\Models\Bantenprov\GroupEgovernment\GroupEgovernment;

/* Etc */
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
    public function __construct(GroupEgovernment $group_egovernment)
    {
        $this->group_egovernment = $group_egovernment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->sort);

            $query = $this->group_egovernment->orderBy($sortCol, $sortDir);
        } else {
            $query = $this->group_egovernment->orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('label', 'like', $value)
                    ->orWhere('description', 'like', $value);
            });
        }

        $perPage = $request->has('per_page') ? (int) $request->per_page : null;
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
        $group_egovernment = $this->group_egovernment;
        $group_egovernment->id = null;
        $group_egovernment->label = null;
        $group_egovernment->description = null;

        $response['group_egovernment'] = $group_egovernment;
        $response['loaded'] = true;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupEgovernment  $group_egovernment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group_egovernment = $this->group_egovernment;

        $validator = Validator::make($request->all(), [
            'label' => 'required|max:16|unique:group_egovernments,label',
            'description' => 'max:255',
        ]);

        if($validator->fails()){
            $check = $group_egovernment->where('label',$request->label)->whereNull('deleted_at')->count();

            if ($check > 0) {
                $response['message'] = 'Failed, label ' . $request->label . ' already exists';
            } else {
                $group_egovernment->label = $request->label;
                $group_egovernment->description = $request->description;
                $group_egovernment->save();

                $response['message'] = 'success';
            }
        } else {
            $group_egovernment->label = $request->label;
            $group_egovernment->description = $request->description;
            $group_egovernment->save();

            $response['message'] = 'success';
        }

        $response['loaded'] = true;

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
        $group_egovernment = $this->group_egovernment->findOrFail($id);

        $response['group_egovernment'] = $group_egovernment;
        $response['loaded'] = true;

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
        $group_egovernment = $this->group_egovernment->findOrFail($id);

        $response['group_egovernment'] = $group_egovernment;
        $response['loaded'] = true;

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
        $group_egovernment = $this->group_egovernment->findOrFail($id);

        if ($request->old_label == $request->label)
        {
            $validator = Validator::make($request->all(), [
                'label' => 'required|max:16',
                'description' => 'max:255',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'label' => 'required|max:16|unique:group_egovernments,label',
                'description' => 'max:255',
            ]);
        }

        if ($validator->fails()) {
            $check = $group_egovernment->where('label',$request->label)->whereNull('deleted_at')->count();

            if ($check > 0) {
                $response['message'] = 'Failed, label ' . $request->label . ' already exists';
            } else {
                $group_egovernment->label = $request->label;
                $group_egovernment->description = $request->description;
                $group_egovernment->save();

                $response['message'] = 'success';
            }
        } else {
            $group_egovernment->label = $request->label;
            $group_egovernment->description = $request->description;
            $group_egovernment->save();

            $response['message'] = 'success';
        }

        $response['loaded'] = true;

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
        $group_egovernment = $this->group_egovernment->findOrFail($id);

        if ($group_egovernment->delete()) {
            $response['loaded'] = true;
        } else {
            $response['loaded'] = false;
        }

        return json_encode($response);
    }
}
