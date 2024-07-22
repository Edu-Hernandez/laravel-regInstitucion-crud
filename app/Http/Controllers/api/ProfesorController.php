<?php
namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeProfesorRequest;
use App\Http\Requests\updateProfesorRequest;
use App\Http\Resources\ProfesorResource;
use App\Interfaces\ProfesorRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    //primeramente se realiza la inyecciòn
    private ProfesorRepositoryInterface  $profesorRepositoryInterfaz;

    //implementamos la inyeccion
    public function __construct(ProfesorRepositoryInterface $profesorRepositoryInterface)
    {
        $this->profesorRepositoryInterfaz = $profesorRepositoryInterface;
    }

    //definicion de metodos
    public function index()
    {
        $data = $this->profesorRepositoryInterfaz->getAll();
        return ApiResponseHelper::sendResponse(ProfesorResource::collection($data), '', 200);
    }

    public function show(string $id)
    {
        try {
            $profesor = $this->profesorRepositoryInterfaz->getById($id);
            return ApiResponseHelper::sendResponse(new ProfesorResource($profesor), '', 200);
        } catch (ModelNotFoundException $ex) {
            return ApiResponseHelper::throw($ex, 'Teacher not found');
        } catch (Exception $e) {
            return ApiResponseHelper::rollback($e, 'Failed Failed');
        }
    }

    public function store(storeProfesorRequest $request)
    {
        $data = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'edad' => $request->edad,
            'email' => $request->email

        ];

        //comensar la transacción
        DB::beginTransaction();
        try {
            $profesor = $this->profesorRepositoryInterfaz->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new ProfesorResource($profesor));
        } catch (Exception $ex) {

            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function update(updateProfesorRequest $request, string $id)
    {

        $data = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'edad' => $request->edad,
            'email' => $request->email

        ];
        DB::beginTransaction();
        try {
            $this->profesorRepositoryInterfaz->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Record updated sucess', 200);
        } catch (Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
            //return ApiResponseHelper::throw($ex);
        }
    }

    public function destroy($id){
        $this->profesorRepositoryInterfaz->delete($id);
        return ApiResponseHelper::sendResponse(null, 'Record deleted success', 200);
    }
}
