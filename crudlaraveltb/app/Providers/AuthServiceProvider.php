<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {

        $this->registerPolicies();

        Gate::define('access', function(User $user){
            return $user->key == 'aluno2024';
        });

        // Define gate for terceirizado role
        Gate::define('access-terceirizado', function(User $user) {
            return $user->key === 'abc123';
        });

        // Define gate for professor role
        Gate::define('access-professor', function(User $user) {
            // Verifica se o último caractere da chave 'key' é 4 ou 5
            return in_array(substr($user->key, -1), ['4', '5']);
        });
        

        //
    }
}
