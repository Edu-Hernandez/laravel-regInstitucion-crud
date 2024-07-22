<?php
namespace App\Providers;

use App\Http\Controllers\api\ProfesorController;
use App\Interfaces\AuxiliarRepositoryInterface;
use App\Interfaces\DirectorRepositoryInterface;
use App\Interfaces\ProfesorRepositoryInterface;
use App\Interfaces\RepresentativeRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Repositories\AuxiliarRepository;
use App\Repositories\DirectorRepository;
use App\Repositories\ProfesorRepository;
use App\Repositories\RepresentativeRepository;
use App\Repositories\StudentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //dentro del metodo bind va dos class
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(ProfesorRepositoryInterface::class, ProfesorRepository::class);
        $this->app->bind(AuxiliarRepositoryInterface::class, AuxiliarRepository::class);
        $this->app->bind(RepresentativeRepositoryInterface::class, RepresentativeRepository::class);
        $this->app->bind(DirectorRepositoryInterface::class, DirectorRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
