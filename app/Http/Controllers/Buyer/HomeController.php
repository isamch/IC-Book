<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Services\Buyer\HomeService as BuyerHomeService;


class HomeController extends Controller
{
    protected $homeService;

    public function __construct(BuyerHomeService $homeService)
    {
        $this->homeService = $homeService;
    }


    public function index()
    {
        $elecBookOfTheMonth = $this->homeService->getElectronicBookOfTheMonth();
        $topElecBooks = $this->homeService->getTopElectronicBooks();

        return view('buyer.home', compact('topElecBooks', 'elecBookOfTheMonth'));
    }
}
