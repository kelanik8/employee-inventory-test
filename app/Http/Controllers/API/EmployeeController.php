<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->get();
        $data = $employees->toArray();

        $response = [
            'status' => 'success',
            'data' => $data,
            'message' => 'Employees retrieved successfully.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'position_held' => 'required',
            'salary' => 'required',
            'work_type' => 'required',
            'status' => 'required',
            'status_time' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 'error',
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $employee = Employee::create($input);
        $data = $employee->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Employee created successfully.'
        ];

        return response()->json($response, 200);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        $data = $employee->toArray();

        if (is_null($employee)) {
            $response = [
                'status' => 'error',
                'data' => [],
                'message' => 'Employee not found.'
            ];
            return response()->json($response, 404);
        }


        $response = [
            'status' => 'success',
            'data' => $data,
            'message' => 'Employee data retrieved successfully.'
        ];

        return response()->json($response, 200);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'position_held' => 'required',
            'salary' => 'required',
            'work_type' => 'required',
            'status' => 'required',
            'status_time' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 'error',
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $employee->update($input);
        $employee->save();

        $data = $employee->toArray();

        $response = [
            'status' => 'success',
            'data' => $data,
            'message' => 'Employee Data updated successfully.'
        ];

        return response()->json($response, 200);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        $data = $employee->toArray();

        $response = [
            'status' => 'success',
            'data' => $data,
            'message' => 'Employee deleted successfully.'
        ];

        return response()->json($response, 200);
    }
}
