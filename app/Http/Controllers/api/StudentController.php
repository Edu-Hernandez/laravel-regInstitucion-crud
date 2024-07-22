<?php
namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeStudentRequest;
use App\Http\Requests\updateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Interfaces\StudentRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class StudentController extends Controller
{
    //
    private StudentRepositoryInterface $studentRepositoryInterface;

    //vamos a implementar la inyeccion de dependencias a travez del constructor
    public function __construct(StudentRepositoryInterface $studentRepositoryInterface)
    {
        //se asigna la instancia inyectada
        $this->studentRepositoryInterface = $studentRepositoryInterface;
    }
    
    public function index()
    {
        $data = $this->studentRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(StudentResource::collection($data), '', 200);
    }

    public function show(string $id)
    {
        try{
        $student = $this->studentRepositoryInterface->getById($id);
        //new StudentResource($student) es una instancia
        return ApiResponseHelper::sendResponse(new StudentResource($student),'', 200);
        }catch(ModelNotFoundException $ex){
            return ApiResponseHelper::throw($ex, 'Student not found');
        } catch (Exception $e){
            return ApiResponseHelper::throw($e, 'An error occurred');
        }
    }
    
    public function store(storeStudentRequest $request)
    {
        $data = [
            'name' => $request->name,
            'age' => $request->age
        ];
        //que comiense la transaccion
        DB::beginTransaction();
        try {
            $student = $this->studentRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new StudentResource($student), 'Record create succesful', 201);
        } catch (Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex); //lo cambie a throw : antes rollback
        }


    }
    
    public function update(updateStudentRequest $request, string $id) 
{
    // Extraer datos validados del request
    $data = [
        'name' => $request->name,
        'age' => $request->age
    ];

    // Iniciar la transacción
    DB::beginTransaction();
    try {
        // Actualizar el registro en el repositorio
        $this->studentRepositoryInterface->update($data, $id);
        
        // Confirmar la transacción
        DB::commit();
        
        // Devolver una respuesta de éxito
        return ApiResponseHelper::sendResponse(null, 'Record updated successfully', 200);
    } catch (Exception $ex) {
        // Revertir la transacción en caso de error
        DB::rollBack();
        
        // Devolver una respuesta de error
        return ApiResponseHelper::rollback($ex);
        //return ApiResponseHelper::throw($ex);
    }
}

    public function destroy($id)
    {
        $this->studentRepositoryInterface->delete($id);
        return ApiResponseHelper::sendResponse(null, 'Record deleted successful', 200);
    }

}
