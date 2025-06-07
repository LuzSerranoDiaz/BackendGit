<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\EmployeeSpecialtyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\checkRole;

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/acerca-de', [PageController::class, 'acercaDe'])->name('acerca-de');
Route::get('/equipo', [PageController::class, 'equipo'])->name('equipo');
Route::get('/servicios', [PageController::class, 'servicios'])->name('servicios');
Route::get('/contacto', [PageController::class, 'contacto'])->name('contacto');
Route::get('/portada', [PageController::class, 'portada'])->name('portada');


Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

// Rutas registro y login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


//protected route
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Ruta logout
    Route::post('logout', [AuthController::class, 'logout']);
    // Ruta para obtener los datos y un usuario autenticado
    Route::get('getUser', [AuthController::class, 'getUser']);
    // Perfil Usuario
    Route::post('profile', [ProfileController::class, 'add']);
    Route::put('profile', [ProfileController::class, 'update']);

    // Clientes
    Route::get('customers', [CustomerController::class, 'show'])->middleware(checkRole::class);
    Route::post('customers', [CustomerController::class, 'add'])->middleware(checkRole::class);
    Route::post('{id}/customers', [CustomerController::class, 'addClient'])->middleware(checkRole::class);
    Route::get('customers/{id}', [CustomerController::class, 'getCustomer'])->middleware(checkRole::class);
    Route::get('customersUser/{id}', [CustomerController::class, 'getCustomerUserId']);
    Route::put('customers/{id}', [CustomerController::class, 'update'])->middleware(checkRole::class);
    Route::put('customers/{id}', [CustomerController::class, 'update'])->middleware(checkRole::class);
    Route::delete('customers/{id}', [CustomerController::class, 'delete'])->middleware(checkRole::class);

    // Rutas para gestionar contratos de un cliente específico
    Route::post('customers/{id}/contracts', [ContractController::class, 'add'])->middleware(checkRole::class);
    Route::get('contracts', [ContractController::class, 'showAll'])->middleware(checkRole::class);
    Route::get('{id}/contracts', [ContractController::class, 'show'])->middleware(checkRole::class);
    Route::get('customers/{id}/contracts/{contractId}', [ContractController::class, 'getContract'])->middleware(checkRole::class);
    Route::put('contracts/{contractId}', [ContractController::class, 'update'])->middleware(checkRole::class);
    Route::delete('contracts/{contractId}', [ContractController::class, 'delete'])->middleware(checkRole::class);

    //Empleados
    Route::post('employees', [EmployeeController::class, 'add'])->middleware(checkRole::class);
    Route::post('{id}/employees', [EmployeeController::class, 'addEmployee'])->middleware(checkRole::class);
    Route::get('employees', [EmployeeController::class, 'show']);
    Route::get('employees/{id}', [EmployeeController::class, 'getEmployee']);
    Route::put('employees/{id}', [EmployeeController::class, 'update'])->middleware(checkRole::class);
    Route::delete('employees/{id}', [EmployeeController::class, 'delete'])->middleware(checkRole::class);

    //Citas
    Route::post('appointments', [AppointmentController::class, 'add']);
    /**
     *      nombre_cliente y nombre_empleado: string
     *      DNI_cliente y DNI_empleado: string con ocho digitos y una letra
     *      fecha: datetime
     *      estado: enum ('pendiente', 'cancelado', 'completo')
     *      skip: el numero de lineas que se saltara la query, por ejemplo skip(5) no ensena las primeras 5 lineas de la tabla
     *      take: el numero de lineas que ensenara/limitara la query, por ejemplo take(5) solo ensena 5 lineas
     *      withServicios: un booleano falso, escribe un string "true" para enseñar los servicios asociados a su cita, cualquier otra cosa para no hacerlo 
     * 
     * Se manda con parametros, que toman forma de por ejemplo "appointments?nombreCliente=Rafa&nombre_empleado:Alicia"
     */
    Route::get('appointments', [AppointmentController::class, 'show'])->middleware(checkRole::class);
    Route::get('appointments/{id}/{withServicios}', [AppointmentController::class, 'getAppointment'])->middleware(checkRole::class);
    Route::put('appointments/{id}', [AppointmentController::class, 'update'])->middleware(checkRole::class);
    Route::delete('appointments/{id}', [AppointmentController::class, 'delete'])->middleware(checkRole::class);

    //Servicios
    Route::post('services', [ServiceController::class, 'add'])->middleware(checkRole::class);
    Route::get('services', [ServiceController::class, 'show']);
    Route::get('services/{id}', [ServiceController::class, 'getService'])->middleware(checkRole::class);
    Route::put('services/{id}', [ServiceController::class, 'update'])->middleware(checkRole::class);
    Route::delete('services/{id}', [ServiceController::class, 'delete'])->middleware(checkRole::class);

    // Especialidades
    Route::post('specialties', [SpecialtyController::class, 'add'])->middleware(checkRole::class);
    Route::get('specialties', [SpecialtyController::class, 'show'])->middleware(checkRole::class);
    Route::get('specialties/{id}', [SpecialtyController::class, 'getSpecialty'])->middleware(checkRole::class);
    Route::put('specialties/{id}', [SpecialtyController::class, 'update'])->middleware(checkRole::class);
    Route::delete('specialties/{id}', [SpecialtyController::class, 'delete'])->middleware(checkRole::class);

    // Rutas para asignar especialidades a empleados
    Route::post('employees/{employee}/specialties', [EmployeeSpecialtyController::class, 'assign'])->middleware(checkRole::class);
    Route::get('employees/{employee}/specialties', [EmployeeSpecialtyController::class, 'list'])->middleware(checkRole::class);
    Route::delete('employees/{employee}/specialties/{specialty}', [EmployeeSpecialtyController::class, 'delete'])->middleware(checkRole::class);
});

