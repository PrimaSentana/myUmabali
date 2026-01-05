<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekStatusAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find(Auth::id());

        if($user && $user->is_admin === false) {
            Notification::make()
            ->title('Anda tidak punya akses ke route yang dituju!')
            ->danger()
            ->send();
            return redirect()->route('xdashboard');
        }

        return $next($request);
    }
}
