# Technical task for PHP position
## Description
### TronApi
 
### Technical tasks
* Creation of a new project based on the latest available, stable version of the Laravel framework. 
* Blocking all paths, leaving only API routing.
* Installing the package https://github.com/iexbase/tron-api via composer.
* Creation of migration to create a wallets table, with columns: id, address, secret, timestamps.
* Creating a Tron Controller in API with two functions: on creating a wallet and downloading the wallet balance (described below).
* The function of creating a wallet: using a previously added package, creating a function (and an endpoint for it) that will generate a new wallet address in the Tron network and save this address in the database (address column) and the private key for it (secret column). The JSON response should return information about the generated address.
* Balance checking function: using a previously added package, creating a function (and an endpoint for it), which, after entering the wallet address in the URL parameter, will return the available amount of TRX cryptocurrency in the JSON response.

### Running and usage
* step 1: Make sure that `extension=gmp` is enabled in php.ini. If not, turn it on. Otherwise TronApi library will not be installed
* step 2: in the command line run `composer install`.
* step 3: Set up your .env file with DB settings. In the comand line run the command `php artisan key:generate`.
* step 4: In the comand line run the command `php artisan migrate` to create tables in database.
* step 5: You can use postman for this step to make an API request. API Endpoint: `/api/create-create-tron-account`, method: "POST".
* step 6. In order to get information regarding the balance of the account, make another request. API Endpoint: `/api/get-balance?account_address='paste address of the wallet here'`, method: `GET`.
