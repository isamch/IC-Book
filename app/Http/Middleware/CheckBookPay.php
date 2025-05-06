<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBookPay
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        dd($request);

        $hasBoughtBook = Order::where('buyer_id', $user->buyer->id)
            ->where('electronic_book_id', $request->get('id'))
            ->where('status', 'paid')
            ->exists();

        if (!$hasBoughtBook) {
            return redirect()->route('home')->with('error', 'need to buy this book');
        }


        return $next($request);
    }
}
