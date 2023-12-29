<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidarRegisterFunction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'dni' => 'required|string|min:8',
            'region_id' => 'required|exists:regions,id_reg',
            'commune_id' => 'required|exists:communes,id_com',
            'email' => 'required|email|unique:customers|max:255',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        return $next($request);
    }
}
