<?php
namespace App\Classes;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ApiResponseHelper{
    
    //Este método se encarga de manejar transacciones en la base de datos. 
    public static function rollback($e, $message = 'Failure in the process'){
        //gestiona transacciones en la base de datos
        //rollback realiza una vuelta atras en la bd y luego lanza una transaccion

        //para deshacer cualquier cambio no confirmado en la base de datos
        DB::rollback();

        //reregistrar el error en el gistro y lanzar una excepción HTTP con un mensaje personalizado.
        self::throw($e,$message); //llamamos al siguiente metodo para registrar el error y lanzar una excepcion
    }

    //metodo que registra el error y lanza una excepcion
    public static function throw($e, $message = 'Failure in the process'){
        //registrar errores para la revision
        Log::info($e);
        //lanza excepciones con respuestas http personalizadas
        throw new HttpResponseException(response()->json(
            [
                'message' => $message
            ], 500
            ));
    }

    //enviamos una respuesta json con los datos recepcionados
    public static function sendResponse($result, $message = '', $code = 200){
    
        // Si el código es 204, se devuelve respuesta sin contenido
        if ($code === 204) {
            return response()->noContent(); // Respuesta sin contenido
        }
    
        // Construcción de la respuesta JSON con los datos proporcionados
        $response = [
            'success' => true,
            'data' => $result
        ];
    
        // Añadir el mensaje opcional si no está vacío
        if (!empty($message)) {
            $response['message'] = $message;
        }
        
        // Devolver la respuesta JSON con el código de estado
        return response()->json($response, $code);
    }
}