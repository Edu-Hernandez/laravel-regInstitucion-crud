<?php
namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeAuxiliarRequest;
use App\Http\Requests\updateAuxiliarRequest;
use App\Http\Resources\AuxiliarResource;
use App\Interfaces\AuxiliarRepositoryInterface;
use App\Models\Enums\Enumtype;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuxiliarController extends Controller
{
    //realizar la inyección
    private AuxiliarRepositoryInterface $auxiliarRepositoryInterfaz;

    public function __construct(AuxiliarRepositoryInterface $auxiliarRepositoryInterface)
    {
        $this->auxiliarRepositoryInterfaz = $auxiliarRepositoryInterface;
    }

    //iniciamos creando ya los metodos del crud

    //funcion de mostrar todos los registros
    public function index()
    {
        $data = $this->auxiliarRepositoryInterfaz->getAll();
        return ApiResponseHelper::sendResponse(AuxiliarResource::collection($data), '', 200);
    }



    //funcion de mostrar un registro
    public function show(string $id)
    {
        try {
            $auxiliar = $this->auxiliarRepositoryInterfaz->getById($id);
            return ApiResponseHelper::sendResponse(new AuxiliarResource($auxiliar), '', 200);
        } catch (ModelNotFoundException $ex) {
            return ApiResponseHelper::throw($ex, 'Auxiliar no encontrado');
        } catch (Exception $e) {
            return ApiResponseHelper::rollback($e, 'Alerta: Hay un error');
        }
    }


    //funcion que se encarga de insertar registros
    public function store(storeAuxiliarRequest $request)
{
    $data = [
        'nombre' => $request->nombre,
        'email' => $request->email,
        'dni' => $request->dni,
        'turno' => Enumtype::from($request->turno)
    ];

    

    DB::beginTransaction();
    try {
        $auxiliar = $this->auxiliarRepositoryInterfaz->store($data);
        DB::commit();
        return ApiResponseHelper::sendResponse(new AuxiliarResource($auxiliar));
    } catch (Exception $ex) {
        DB::rollBack();
        // Loguear el error para depuración
        Log::error('Error al guardar auxiliar: ' . $ex->getMessage());
        // Devolver un mensaje de error específico
        return ApiResponseHelper::throw($ex, 'Error al guardar el auxiliar. Por favor, inténtelo de nuevo más tarde.');
    }
}


    public function update(updateAuxiliarRequest $request, $id)
    {

        $data = [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'dni' => $request->dni,
            'turno' => Enumtype::from($request->turno)
        ];

        DB::beginTransaction();
        try {
            $this->auxiliarRepositoryInterfaz->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Se realizó la actualización', 200);
        } catch (Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function destroy($id){
        $this->auxiliarRepositoryInterfaz->delete($id);
        return ApiResponseHelper::sendResponse(null, 'Se elimino el registro', 200);
    }


    //

}
