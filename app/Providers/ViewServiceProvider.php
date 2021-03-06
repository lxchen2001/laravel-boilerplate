<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Share hot mode for views
         */
        View::composer('*', function (\Illuminate\View\View $view) {
            $view->with('hmr', file_exists(public_path('/hot')));
        });

        /*
         * Prepare flash message for alerts
         */
        View::composer('partials/messages', function (\Illuminate\View\View $view) {
            $data = collect($view->getData());

            if ($flash = session()->get('flash_message') ?: $data->get('flashMessage')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'info');
            } elseif ($flash = session()->get('flash_success') ?: $data->get('flashSuccess')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'success');
            } elseif ($flash = session()->get('flash_info') ?: $data->get('flashInfo')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'info');
            } elseif ($flash = session()->get('flash_warning') ?: $data->get('flashWarning')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'warning');
            } elseif ($flash = session()->get('flash_danger') ?: $data->get('flashDanger')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'danger');
            } elseif ($flash = session()->get('flash_error') ?: $data->get('flashError')) {
                $view->with('flashMessage', $flash);
                $view->with('flashType', 'danger');
            }
        });

        View::composer('*', function (\Illuminate\View\View $view) {
            $view->with('loggedInUser', auth()->user());
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
