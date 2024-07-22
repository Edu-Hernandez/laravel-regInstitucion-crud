<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeRepresentativeRequest;
use App\Http\Resources\RepresentativeResource;
use App\Interfaces\RepresentativeRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RepresentativeController extends Controller
{

    //inyección
    private RepresentativeRepositoryInterface $representativeRepositoryInterface;

    public function __construct(RepresentativeRepositoryInterface $representativeRepositoryInterface) {
        $this->representativeRepositoryInterface = $representativeRepositoryInterface;
    }


    //metodos
    public function index(){
        $data = $this->representativeRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(RepresentativeResource::collection($data));
    }


    public function show(string $id){
        try {
            $representative = $this->representativeRepositoryInterface->getById($id);
            return ApiResponseHelper::sendResponse(new RepresentativeResource($representative), '', 200);
        } catch (ModelNotFoundException $ex) {
            return ApiResponseHelper::throw($ex, 'No se encontro este usuario');
        } catch (Exception $ex){
            return ApiResponseHelper::rollback($ex, 'Failed Failed');
        }
    }



    public function store(storeRepresentativeRequest $request){
        
        $data = [
            'id_student' => $request->id_student,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'dni' => $request->dni,
            'phone' => $request->phone
        ];

        DB::beginTransaction();
        try {
            $representative = $this->representativeRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new RepresentativeResource($representative));
        } catch (Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }



    public function update(storeRepresentativeRequest $request, string $id){
        
        $data = [
            'id_student' => $request->id_student,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'dni' => $request->dni,
            'phone' => $request->phone
        ];

        DB::beginTransaction();
        try {
            $this->representativeRepositoryInterface->update($data,$id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'se actualizó los valores', 200);
        } catch (Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }


    public function destroy($id){
        $this->representativeRepositoryInterface->delete($id);
        return ApiResponseHelper::sendResponse(null, 'Se eliminó el registro',200);
    }

}
