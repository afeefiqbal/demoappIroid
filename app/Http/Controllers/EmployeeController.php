<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\EmployeeInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
class employeeController extends Controller
{
    protected  $employeeInterface;

    public function __construct(EmployeeInterface  $employeeInterface)
    {
        $this->employeeInterface =  $employeeInterface;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data  = $this->employeeInterface->listemployee(); 
         
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn1 = '<a href="'.route('employee.show',$row->id).'" class="btn btn-primary btn-sm">View</a>';
                    $btn2 = '<a href="'.route('employee.edit',$row->id).'" class="btn btn-primary btn-sm">edit</a>';
                    $btn3 = '<a href="/admin/employee/'.$row->id.'/delete" class="btn btn-primary btn-sm">delete</a>';
                    return $btn1.' '.$btn2.' '.$btn3;
                })
              
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::get();
        return view('employee.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->image;

      
     
         $input = $request->all();
        
        try {
              $employeeInterface = $this->employeeInterface->createemployee($input );
            if( $employeeInterface){
                $type = 'success';
                $message = '';
                return redirect()->back()->with('message', 'employee created succesfully!');
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            $e->getCode();
            $e->getMessage();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data  = $this->employeeInterface->findemployeeById($id); 
        return view('employee.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data  = $this->employeeInterface->findemployeeById($id);
        $companies = Company::get(); 
        return view('employee.edit',compact('data','companies'));
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
        $input = $request->all();
        
        try {
              $employeeInterface = $this->employeeInterface->updateemployee($input,$id);
            if( $employeeInterface){
                $type = 'success';
                $message = '';
                return redirect()->back()->with('message', 'employee updated succesfully!');
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            $e->getCode();
            $e->getMessage();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
             $employeeInterface = $this->employeeInterface->deleteemployee($id );
            if ( $employeeInterface) {
                return redirect()->back()->with('message', 'employee deleted succesfully!');
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            $e->getCode();
            $e->getMessage();
            throw $e;
        }
    }
}
