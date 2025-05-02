<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\ElectronicBook;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class StripeController extends Controller
{

    private $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.secret'));
    }


    // public function index($id)
    // {
    //     return view('');
    // }

    public function createSession($id)
    {

        $ElectronicBook = ElectronicBook::findOrFail($id);
        // $imageUrl = asset('storage/' . optional($ElectronicBook->Book->images->first())->image);




        if ($this->checkIfAlreadyBuyBook($id)) {
            return redirect()->route('buyer.books.preview.pdf', $id)->with('success', 'You have already Buy this book.');
        }

        $session = $this->stripe->checkout->sessions->create([
            'customer_creation' => 'if_required',
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $ElectronicBook->Book->price * 100,
                    'product_data' => [
                        'name' => $ElectronicBook->Book->title,
                        'description' => $ElectronicBook->Book->description,
                        'images' => [
                            "https://scontent.fcmn1-2.fna.fbcdn.net/v/t39.30808-6/301581864_396402069295183_9003054836127261947_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeFUUg1rYtZ0vEFX1z9NqdBD_sDGuHkIPrj-wMa4eQg-uGJ5287I5kPJqQoTA39JKV68ElkJtmPJIS7HTLyQJJq2&_nc_ohc=OSqumEpTjDkQ7kNvwGpq8iE&_nc_oc=AdlCXZq97KcvRWWpL4PAFFAyw3yWALWdG4PdjuAtT-7UCfEnsVrZiXa8YrM5wDox054&_nc_zt=23&_nc_ht=scontent.fcmn1-2.fna&_nc_gid=m5Hi-ETd2UGDcdG6Y6UQ4g&oh=00_AfFWim0kRet36nq8k1oTcJqlCSawzFRm44N3MYL_Ad0jKg&oe=6806F3BD",
                        ],

                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('buyer.payment.stripe.success', $ElectronicBook->id) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('buyer.books.show', $id),
        ]);



        return redirect($session->url);
    }


    public function success(Request $request, $id)
    {


        $session_id = $request->get('session_id');

        $session = $this->stripe->checkout->sessions->retrieve($session_id);

        if (!$session || $session->payment_status !== 'paid') {
            abort(403, 'Invalid operation');
        }

        $ElectronicBook = ElectronicBook::findOrFail($id);
        $this->createOrder($ElectronicBook);

        return redirect()->route('buyer.books.preview.pdf', $id)->with('success', 'Your payment was successfully completed.');
    }


    // private methods to create order
    private function createOrder($ElectronicBook)
    {

        $order = $ElectronicBook->orders()->create([
            'status' => 'completed',
            'total_price' => $ElectronicBook->Book->price,
            'buyer_id' => Auth::user()->buyer->id,
            'electronic_book_id' => $ElectronicBook->id,
        ]);

        return $order;
    }


    private function checkIfAlreadyBuyBook($id)
    {

        $user = Auth::user();

        $hasBuyBook = Order::where('buyer_id', $user->buyer->id)
            ->where('electronic_book_id', $id)
            ->where('status', 'completed')
            ->exists();


        return $hasBuyBook;
    }
}
