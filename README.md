# Zadanie techniczne na stanowisko Junior PHP
## Opis
### TronApi
 
### Zadania techniczne
* Stworzenie nowego projektu w oparciu o najnowszą dostępną stabilną wersję frameworka Laravel.
* Blokowanie wszystkich ścieżek, pozostawiając tylko routing API.
* Instalowanie pakietu https://github.com/iexbase/tron-api przez kompozytor.
* Stworzenie migracji w celu utworzenia tabeli portfeli z kolumnami: id, adres, sekret, znaczniki czasu.
* Stworzenie kontrolera Tron w API z dwiema funkcjami: przy tworzeniu portfela i pobieraniu salda portfela (opisane poniżej).
* Funkcja tworzenia portfela: wykorzystanie wcześniej dodanego pakietu, stworzenie funkcji (i jej punktu końcowego), która wygeneruje nowy adres portfela w sieci Tron i zapisze ten adres w bazie danych (kolumna adresu) oraz klucz prywatny za to (tajna kolumna). Odpowiedź JSON powinna zwrócić informację o wygenerowanym adresie.
* Funkcja sprawdzania salda: korzystając z dodanego wcześniej pakietu, tworzenie funkcji (i jej punktu końcowego), która po wpisaniu adresu portfela w parametrze URL zwróci dostępną ilość kryptowaluty TRX w odpowiedzi JSON.

### Bieganie i użytkowanie
* krok 1: upewnij się, że „rozszerzenie = gmp” jest włączone w php.ini. Jeśli nie, włącz go. W przeciwnym razie biblioteka TronApi nie zostanie zainstalowana.
* krok 2: w linii poleceń uruchom "composer install".
* krok 3: Możesz użyć listonosza w tym kroku, aby wysłać żądanie API. URL: „/ api / create-create-tron-account”, metoda: „POST”.
* krok 4. W celu uzyskania informacji o saldzie na rachunku składa kolejną prośbę. URL: "/ api / get-balance? Account_address = 'wklej tutaj adres portfela'", metoda: "GET".


# Technical task for a Junior PHP position
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
* step 1: Make sure that "extension=gmp" is enabled in php.ini. If not, turn it on. Otherwise TronApi library will not be installed
* step 2: in the command line run "composer install".
* step 3: You can use postman for this step to make an API request. URL: "/api/create-create-tron-account", method: "POST".
* step 4. In order to get information regarding the balance of the account, make another request. URL: "/api/get-balance?account_address='paste address of the wallet here'", method: "GET".
