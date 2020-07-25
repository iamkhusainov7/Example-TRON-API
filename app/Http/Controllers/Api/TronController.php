<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tron;
use \IEXBase\TronAPI\Tron as TronApi;
use \IEXBase\TronAPI\Provider\HttpProvider;

class TronController extends Controller
{
    /**
     * Creates a wallet in Tron network and returns its address.
     *
     * @return Illuminate\Contracts\Routing\ResponseFactory::json containing created address
     */
    public function createWallet()
    {
        $tron = $this->connectTron();
        [
            'privateKey' => $secret,
            'address' => $address
        ] = $tron->createAccount();     //destructing the result into variables

        try {
            Tron::create(['secret' => $secret, 'address' => $address]);
        } catch (\Exception $e) {
            return response()
                ->json(["message" => $e->getMessage()], 500);
        }

        return response()
            ->json([
                "message" => 'Wallet was successfully created',
                "wallet-address" => $address,
            ], 201);
    }

    /**
     * Connects to Tron network via api.
     *
     * @return \IEXBase\TronAPI\Tron
     */
    protected function connectTron()
    {
        $fullNode = new HttpProvider('https://api.trongrid.io');
        $solidityNode = new HttpProvider('https://api.trongrid.io');
        $eventServer = new HttpProvider('https://api.trongrid.io');

        try {
            $tron = new TronApi($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            return response()
                ->json(["message" => $e->getMessage()], 500);
        }

        return $tron;
    }
}
