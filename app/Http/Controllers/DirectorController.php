<?php
namespace App\Http\Controllers;

use App\Classes\ApiResponseHelper;
use App\Http\Requests\storeDirectorRequest;
use App\Http\Requests\updateDirectorRequest;
use App\Http\Resources\DirectorResource;
use App\Interfaces\DirectorRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class DirectorController extends Controller
{
    private DirectorRepositoryInterface $directorRepositoryInterfaz;

    public function __construct(DirectorRepositoryInterface $directorRepositoryInterface) {
        $this->directorRepositoryInterfaz = $directorRepositoryInterface;
    }

    public function index(){
        $data = $this->directorRepositoryInterfaz->getAll();
        return ApiResponseHelper::sendResponse(DirectorResource::collection($data), '', 200);
    }

    public function show(string $id){
        try {
            $director = $this->directorRepositoryInterfaz->getById($id);
            return ApiResponseHelper::sendResponse(new DirectorResource($director),'',200);
        } catch(ModelNotFoundException $ex){
            return ApiResponseHelper::throw($ex, 'Director not found');
        } 
        catch (Exception $e) {
            return ApiResponseHelper::rollback($e,'Ups! Failed');
        }
    }

    public function store(storeDirectorRequest $request){
        $data = [
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'nombre_institucion' => $request->nombre_institucion
        ];

        DB::beginTransaction();
        try {
            $director = $this->directorRepositoryInterfaz->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new DirectorResource($director),'',200);

        } catch (Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function update(updateDirectorRequest $request, $id){
        
        $data = [
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'nombre_institucion' => $request->nombre_institucion
        ];
        DB::beginTransaction();
        try {
            $this->directorRepositoryInterfaz->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Record Update Director',200);
        } catch (Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }

    }

    public function destroy($id){
        $this->directorRepositoryInterfaz->delete($id);
        return ApiResponseHelper::sendResponse(null,'Registro Eliminado',200);

    }
}
