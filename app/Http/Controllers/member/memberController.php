<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\member;

class memberController extends Controller
{
    public function getMember(Request $request)
    {
        try{
            $members = Member::all();

            if($members->isEmpty()){
                return response()->json([
                    'status' => true,
                    'message' => 'Not have a member.',
                ]);
            }

            return response()->json([
                'status' => true,
                'data' => $members,
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }
    }

    public function createMember(Request $request){
        $validator = Validator::make($request->all(), [
            'm_email' => ['required','email','unique:App\Models\member,m_email'],
            'm_password' => ['required','min:8'],
            'm_name' => ['required']
        ]
        ,[]
        ,[
            'm_email' => 'email',
            'm_password' => 'password',
            'm_name' => 'name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
            ]);
        }

        try{

            $member = member::create([
                'm_email' => $request->input('m_email'),
                'm_password' => Hash::make($request->input('m_password')),
                'm_name' => $request->input('m_name'),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Created m_id',
            ]);

        }catch(\Exception $e){

            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);

        }
    }

    public function getSpecificMember(Request $request,$m_id)
    {
        $member = Member::find($m_id);

        if (!$member) {
            return response()->json([
                'message' => '404 Not Found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $member,
        ]);
    }

    public function updateMember(Request $request,$m_id){

        $member = member::where('m_id', $m_id)->first();

        if(!$member){
            return response()->json([
                'message' => '404 Not Found.',
            ],404);
        }

        $validator = Validator::make(
            $request->all()
            ,[
                'm_email' => [
                    'required',
                    'email',
                    Rule::unique('member', 'm_email')->ignore($m_id, 'm_id')
            ],
                'm_password' => ['required','min:8'],
                'm_name' => ['required']
            ],
            [],
            [
                'm_email' => 'email',
                'm_password' => 'password',
                'm_name' => 'name'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
            ]);
        }

        try{

            member::where('m_id',$m_id)->update([
                'm_email' => $request->input('m_email'),
                'm_password' => Hash::make($request->input('m_password')),
                'm_name' => $request->input('m_name'),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Updated m_id',
            ]);

        }catch(\Exception $e){

            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);

        }

    }

    public function deleteMember(Request $request, $m_id)
{
    $member = member::where('m_id', $m_id)->first();

    if (!$member) {
        return response()->json([
            'message' => '404 Not Found.',
        ], 404);
    }

    try {
        member::where('m_id', $m_id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted member '.$member->m_name.' successfully.',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'An error occurred: ' . $e->getMessage(),
        ], 500);
    }
}


}
