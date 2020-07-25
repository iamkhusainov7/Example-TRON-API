<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tron;
use \IEXBase\TronAPI\Tron as TronApi;
use \IEXBase\TronAPI\Provider\HttpProvider;
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

        $account = Tron::where("address", $request->query('account_address'))
            ->first();

        if (!$account) {
            return response()
                ->json(["message" => 'Account address not found!'], 404);
        }

        $tron = $this->connectTron();

        $balance = $tron->getBalance($account->address, true);

        return response()
            ->json(["balance" => $balance], 200);
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
