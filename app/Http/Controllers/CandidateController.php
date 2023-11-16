<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function display_candidates_list()
    {
       
        $candidates = Candidate::all();
        return response()->json([
                'status' => 'success',
                'candidates' => $candidates,
                
            ]);

    }
    public function create_candidate(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'user_id' => 'required|integer|max:20',
            'position_id' => 'required|integer|max:20',
        ]);

        $candidate = Candidate::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'user_id'=>$request->user_id,
            'position_id'=>$request->position_id,

        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Candidate created successfully',
            'candidate' => $candidate,
            
        ]);

    }

    public function display_one_candidate($id)
    {
       
        $candidate = Candidate::find($id);
        return response()->json([
                'status' => 'success',
                'candidate' => $candidate,
                
            ]);
        }
    public function update_candidate(Request $request , $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'user_id' => 'required|integer|max:20',
            'position_id' => 'required|integer|max:191',
        ]);
       
        $candidate = Candidate::find($id);
        $candidate->first_name = $request->first_name;
        $candidate->last_name = $request->last_name;
        $candidate->user_id= $request->user_id;
        $candidate->position_id = $request->position_id;
        $candidate->save();

        return response()->json([
                'status' => 'success',
                'message' => 'Candidate updated successfully',
                'candidate' => $candidate,
                
            ]);
    }

    public function delete_candidate($id)
    {  
        $candidate = Candidate::find($id);
        $candidate->delete();

        return response()->json([
            'message' => 'Candidate deleted successfully',
            'candidate' => $candidate,
                
            ]);
        }

}
