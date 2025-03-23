<?php

namespace App\Http\Controllers\enroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\enroll;
use App\Models\course;
use App\Models\member;

class enrollController extends Controller
{
    
    public function getAllEnroll(Request $request) {
        
        try{
            $enrolls = enroll::all();

            if($enrolls->isEmpty()){
                return response()->json([
                    'status' => true,
                    'message' => 'Not have a enroll.',
                ]);
            }

            return response()->json([
                'status' => true,
                'data' => $enrolls,
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }

    }

    public function createEnroll(Request $request){

        $validator = Validator::make($request->all(),
        [
            "m_id" => ["required","numeric","exists:App\Models\member,m_id"],
            "c_id" => ["required","numeric","exists:App\Models\course,c_id"],
            "cer_start" => ["required","date","date_format:Y-m-d",'before_or_equal:'.$request->cer_expire],
            "cer_expire" => ["required","date","date_format:Y-m-d",'after_or_equal:'.$request->cer_start],
        ],
        [],
        [
            "m_id" => "member id",
            "c_id" => "course id",
            "cer_start" => "certification start date",
            "cer_expire" => "certification expire date",
        ]
    );

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
            ]);
        }

        $findExist = enroll::where('m_id',$request->m_id)->where('c_id',$request->c_id)->first();

        if($findExist){
            return response()->json([
                'status' => false,
                'message' => 'This enroll already exists.',
            ]);
        }

        try{

            $enroll = enroll::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Enroll created successfully.',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }
    }

    public function getSpecificEnroll(Request $request, $e_id){

        try{
            $enroll = enroll::find($e_id);

            if(!$enroll){
                return response()->json([
                    'message' => '404 Not Found.',
                ],404);
            }

            return response()->json([
                'status' => true,
                'data' => $enroll,
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }

    }

    public function updateEnroll(Request $request,$cer_id){

        $validator = Validator::make($request->all(),
        [
            "m_id" => ["required","numeric","exists:App\Models\member,m_id"],
            "c_id" => ["required","numeric","exists:App\Models\course,c_id"],
            "cer_start" => ["required","date","date_format:Y-m-d",'before_or_equal:'.$request->cer_expire],
            "cer_expire" => ["required","date","date_format:Y-m-d",'after_or_equal:'.$request->cer_start],
        ],
        [],
        [
            "m_id" => "member id",
            "c_id" => "course id",
            "cer_start" => "certification start date",
            "cer_expire" => "certification expire date",
        ]
    );

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
            ]);
        }

        try{

            $enroll = enroll::find($cer_id);

            if(!$enroll){
                return response()->json([
                    'message' => '404 Not Found.',
                ],404);
            }

            $enroll->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Enroll updated successfully.',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }

    }

    public function deleteEnroll(Request $request,$cer_id){

        try{

            $enroll = enroll::find($cer_id);

            if(!$enroll){
                return response()->json([
                    'message' => '404 Not Found.',
                ],404);
            }

            $enroll->delete();

            return response()->json([
                'status' => true,
                'message' => 'Enroll deleted successfully.',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }

    }

    public function getEnrollByMember(Request $request,$m_id){

        try{
            $enrolls = enroll::where('m_id',$m_id)->get();

            if($enrolls->isEmpty()){
                return response()->json([
                    'message' => '404 Not Found.',
                ],404);
            }

            return response()->json([
                'status' => true,
                'data' => $enrolls,
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }

    }

    public function getEnrollByCourse(Request $request,$c_id){

        try{
            $enrolls = enroll::where('c_id',$c_id)->get();

            if($enrolls->isEmpty()){
                return response()->json([
                    'message' => '404 Not Found.',
                ],404);
            }

            return response()->json([
                'status' => true,
                'data' => $enrolls,
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }

    }

}
