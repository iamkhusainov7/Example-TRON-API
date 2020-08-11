<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tron;

use Illuminate\Http\Request;

class TronController extends Controller
{
    /**
     * Creates a wallet in Tron network and returns its address.
     *
     * @return Illuminate\Contracts\Routing\ResponseFactory::json containing created address
     */
    public function createWallet()
    {
        $tron = new Tron();

        try {
            $tron->connectTron()->createAccount();
        } catch (\Exception $e) {
            return response()
                ->json(["message" => $e->getMessage()], 500);
        }

        return response()
            ->json([
                "message" => 'Wallet was successfully created',
                "wallet-address" => $tron->address,
            ], 201);
    }

    /**
     * Gets a Tron network account balance information and returns as JSON format.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Contracts\Routing\ResponseFactory::json containing balance information
     */
    public function getBalance(Request $request)
    {
        if (!$request->query('account_address')) {
            return response()
                ->json(["message" =>  "Account address parameter is not specified"], 400);
        }

        try {
            $balance = Tron::getAccount($request->query('account_address'))
                ->connectTron()
                ->getBalance();
            return response()
                ->json(["balance" => $balance], 200);
        } catch (\Exception $e) {
            return response()
                ->json(["message" => $e->getMessage()], $e->getCode());
        }
    }
}
