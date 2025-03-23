<?php

namespace App\Http\Controllers\course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class courseController extends Controller
{
    
    public function getAllCourse(Request $request)
    {
        try{
            $courses = course::all();

            if($courses->isEmpty()){
                return response()->json([
                    'status' => true,
                    'message' => 'Not have a course.',
                ]);
            }

            return response()->json([
                'status' => true,
                'data' => $courses,
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }
    }

    public function createCourse(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'c_name' => 
                [
                    'required',
                    'string',
                    'max:255',
                ],
                'c_description' => 
                [
                    'required',
                    'string',
                    'max:255',
                ],
                'c_price' => 
                [
                    'required',
                    'numeric',
                    'min:0',
                ],
            ],
            [],
            [
                'c_name' => 'name',
                'c_description' => 'description',
                'c_price' => 'price',
            ]
        );

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }

            $course = course::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Course created successfully.',
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }
    }

    public function getSpecificCourse(Request $request, $c_id)
    {
        try{
            $course = course::find($c_id);

            if(!$course){
                return response()->json([
                    'message' => '404 Not Found.',
                ],404);
            }

            return response()->json([
                'status' => true,
                'data' => $course,
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }
    }

    public function updateCourse(Request $request, $c_id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'c_name' => 
                [
                    'required',
                    'string',
                    'max:255',
                ],
                'c_description' => 
                [
                    'required',
                    'string',
                    'max:255',
                ],
                'c_price' => 
                [
                    'required',
                    'numeric',
                    'min:0',
                ],
            ],
            [],
            [
                'c_name' => 'name',
                'c_description' => 'description',
                'c_price' => 'price',
            ]
        );

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }

            $course = course::find($c_id);

            if(!$course){
                return response()->json([
                    'message' => '404 Not Found.',
                ],404);
            }

            $course->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Course updated successfully.',
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }
    }

    public function deleteCourse(Request $request, $c_id)
    {
        try{
            $course = course::find($c_id);

            if(!$course){
                return response()->json([
                    'message' => '404 Not Found.',
                ],404);
            }

            $course->delete();

            return response()->json([
                'status' => true,
                'message' => 'Course deleted successfully.',
            ]);
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ],500);
        }
    }

}
