<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use \IEXBase\TronAPI\Provider\HttpProvider;
use \IEXBase\TronAPI\Tron as TronApi;

class Tron extends Model
{
    /** 
     * Fillable for mass columns in DB
     * 
     * @var array
     */
    protected $fillable = ['address', 'secret'];

    /**
     * Connects to Tron network via api.
     *
     * @return \IEXBase\TronAPI\Tron
     */
    public function connectTron()
    {
        $fullNode = new HttpProvider('https://api.trongrid.io');
        $solidityNode = new HttpProvider('https://api.trongrid.io');
        $eventServer = new HttpProvider('https://api.trongrid.io');

        try {
            $this->tron = new TronApi($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            throw $e;
        }

        return $this;
    }

    /**
     * This method sends request to create an Tron account
     * 
     * @return App\Tron
     */
    public function createAccount()
    {
        try {
            [
                'privateKey' => $this->secret,
                'address' => $this->address
            ] = $this->tron->createAccount();     //destructing the result into variables
            
            self::create([
                'address' => $this->address,
                'secret' => $this->secret
            ]);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            throw $e;
        }

        return $this;
    }

    /**
     * This method sends request to get account balance from Tron
     * 
     * @return float $balance account balance
     */
    public function getBalance()
    {
        try {
            $balance = $this->tron->getBalance($this->address, true);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            throw $e;
        }
    
        return $balance;
    }

    /**
     * This method retreives account from database
     * 
     * @return App\Tron $account account object
     * @throws \Exception if the account not found 
     */
    public static function getAccount(string $address)
    {
        $account = Tron::where("address", $address)
            ->first();
        if (!$account) {
            throw new Exception('Account not found!', 404);
        }
        return $account;
    }
}
