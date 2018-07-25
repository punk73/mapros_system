<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*DB::listen(function ($sql) {
            // $query->sql;
            // $query->bindings;
            // $query->time;
            $LOG_TABLE_NAME = 'log';
            foreach ($sql->bindings as $i => $binding) {
                if ($binding instanceof \DateTime) {
                    $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                } else {
                    if (is_string($binding)) {
                        $sql->bindings[$i] = "'$binding'";
                    }
                }
            }
            // Insert bindings into query
            $query = str_replace(array('%', '?'), array('%%', '%s'), $sql->sql);
            $query = vsprintf($query, $sql->bindings);

            if(stripos($query, 'insert into `'.$LOG_TABLE_NAME.'`')===false){
                
                fwrite(STDOUT, $query);
            }

        });*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
