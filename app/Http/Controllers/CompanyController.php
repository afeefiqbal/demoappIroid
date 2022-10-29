<?php

namespace App\Http\Controllers;

use App\DataTables\CompanyDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Repositories\CompanyInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
class CompanyController extends Controller
{
    protected $companyInterface;

    public function __construct(CompanyInterface $companyInterface)
    {
        $this->companyInterface = $companyInterface;       
        $this->middleware('is_admin'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $data  = $this->companyInterface->listCompany(); 
          
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn1 = '<a href="'.route('company.show',$row->id).'" class="btn btn-primary btn-sm">View</a>';
                    $btn2 = '<a href="'.route('company.edit',$row->id).'" class="btn btn-primary btn-sm">edit</a>';
                    $btn3 = '<a href="/admin/company/'.$row->id.'/delete" class="btn btn-primary btn-sm">delete</a>';
                    return $btn1.' '.$btn2.' '.$btn3;
                })
                ->addColumn('log', function($row){
                    $btn = '<img src = "'.$row->logo.'" width = "100">';
                    return $btn;
                })
                ->rawColumns(['action','log'])
                ->make(true);
        }

        return view('company.index');

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $image = $request->image;

        if ($image !== null) {
            $fileext = $image->getClientOriginalExtension(); //Get file extension
            $filename = $image->getClientOriginalName(); 
            // $image = $image->move(public_path('/logos/'.$filename));//save file \
            $image->storeAs('public/logos', $filename);
            $upload_photo = asset('logos/'.$filename);
     
            $request['logo'] =  $upload_photo;
         }
         $input = $request->all();
        
        try {
             $companyInterface = $this->companyInterface->createCompany($input );
            if($companyInterface){
                $type = 'success';
                $message = '';
                return redirect()->back()->with('message', 'company created succesfully!');
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
        $data  = $this->companyInterface->findCompanyById($id); 
        return view('company.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data  = $this->companyInterface->findCompanyById($id); 
        return view('company.edit',compact('data'));
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
             $companyInterface = $this->companyInterface->updateCompany($input,$id);
            if($companyInterface){
                $type = 'success';
                $message = '';
                return redirect()->back()->with('message', 'company updated succesfully!');
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            $e->getCode();
            $e->getMessage();
            throw $e;
        }
        //
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
            $companyInterface = $this->companyInterface->deleteCompany($id );
            if ($companyInterface) {
                return redirect()->back()->with('message', 'company deleted succesfully!');
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            $e->getCode();
            $e->getMessage();
            throw $e;
        }

    }
}
