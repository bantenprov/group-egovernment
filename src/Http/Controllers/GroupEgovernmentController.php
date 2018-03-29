<?php

namespace Bantenprov\GroupEgovernment\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\GroupEgovernment\Facades\GroupEgovernmentFacade;

/* Models */
use Bantenprov\GroupEgovernment\Models\Bantenprov\GroupEgovernment\GroupEgovernment;
use App\User;

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
    protected $group_egovernment;
    protected $user;

    public function __construct(GroupEgovernment $group_egovernment, User $user)
    {
        $this->group_egovernment    = $group_egovernment;
        $this->user                 = $user;
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
        $response = $query->with('user')->paginate($perPage);

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
        $users           = $this->user->all();

        foreach ($users as $user) {
            array_set($user, 'label', $user->name);
        }

        $response['user']               = $users;
        $response['status']             = true;

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
            'user_id'       => 'required',
            'label'         => 'required|unique:group_egovernments,label',
            'description'   => 'required',
        ]);

        if($validator->fails()){
            $check = $group_egovernment->where('label',$request->label)->whereNull('deleted_at')->count();

            if ($check > 0) {
                $response['message'] = 'Failed, label ' . $request->label . ' already exists';
            } else {
                $group_egovernment->label         = $request->input('label');
                $group_egovernment->description   = $request->input('description');
                $group_egovernment->user_id       = $request->input('user_id');
                $group_egovernment->save();

                $response['message'] = 'success';
            }
        } else {
                $group_egovernment->label         = $request->input('label');
                $group_egovernment->description   = $request->input('description');
                $group_egovernment->user_id       = $request->input('user_id');
                $group_egovernment->save();

                $response['message'] = 'success';
        }

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
        $group_egovernment = $this->group_egovernment->findOrFail($id);

        $response['user']               = $group_egovernment->user;
        $response['group_egovernment']  = $group_egovernment;
        $response['status']             = true;

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

        array_set($group_egovernment->user, 'label', $group_egovernment->user->name);

        $response['user']               = $group_egovernment->user;
        $response['group_egovernment']  = $group_egovernment;
        $response['status']             = true;

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
        $response = array();
        $message  = array();

        $group_egovernment = $this->group_egovernment->findOrFail($id);

            $validator = Validator::make($request->all(), [
                'label'                 => 'required|unique:group_egovernments,label,'.$id,
                'description'           => 'required',
                'user_id'               => 'required',
            ]);

            if($validator->fails()){

                foreach($validator->messages()->getMessages() as $key => $error){
                    foreach($error AS $error_get) {
                        array_push($message, $error_get);
                    }                
                } 

                $check_label   = $this->group_egovernment->where('id','!=', $id)->where('label', $request->label);

                if($check_label->count() > 0){
                    $response['message'] = implode("\n",$message);

            } else {
                $group_egovernment->label                    = $request->input('label');
                $group_egovernment->description              = $request->input('description');
                $group_egovernment->user_id                  = $request->input('user_id');
                $group_egovernment->save();

                $response['message'] = 'success';
            }

        } else {
                $group_egovernment->label                    = $request->input('label');
                $group_egovernment->description              = $request->input('description');
                $group_egovernment->user_id                  = $request->input('user_id');
                $group_egovernment->save();

                $response['message'] = 'success';

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
        $group_egovernment = $this->group_egovernment->findOrFail($id);

        if ($group_egovernment->delete()) {
            $response['loaded'] = true;
        } else {
            $response['loaded'] = false;
        }

        return json_encode($response);
    }
}
