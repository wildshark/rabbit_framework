
# Rabbit PHP Framework

Rabbit is a PHP framework designed to be easy to develop and deploy. It supports SOAP API communication.

## Framework Structure

The Rabbit framework is organized into the following directories:

* `control/`: This directory contains core framework controllers.
    * `config.php`: Handles all application configuration.
    * `control.php`: Handles framework operations and logic.
    * `navgiate.php`: Handles routing to view pages.
    * `module.php`: Handles action scripts produced by modules.
    * `page.php`: Handles public pages.
    * `rsource.php`: Handles JSON and CSV CRUD operations.
    * `temp.php`: Handles temporary files and folders.
    * `route.php`: Defines routing logic.
* `modular/`: Stores and runs project modules as classes.
* `data/`: Stores JSON data for your application.
* `temp/`: Manages temporary files used by the framework, such as logs, sessions, and uploaded files.
* `frame/`: Contains application template files.
* `view/`: Contains view pages or functions displayed on forms.
* `index.php`: The main entry point of the application.
* `error.log`: Stores system error logs.

## Installation

1. Clone the Rabbit framework repository from GitHub:

```bash
git clone [https://github.com/wildshark/rabbit_framework.git](https://github.com/wildshark/rabbit_framework.git)
```

2. Place your project code within the Rabbit framework directory structure.

## Configuration (config.php)

The `config.php` file stores application configuration settings. Here are some examples:

```php
define("HEADER_TITLE",'Bank'); // The application title
define("HOST", 'http://localhost'); // The host
define("QUERY_URL",'/apis/susubank/server.php'); // The URL query endpoint
define("BNK",'356a1-92b79-13b04-c5457-4d18c-28d46-e6395-428ab'); // Endpoint token
```

## Navigation (navgiate.php)

The `navgiate.php` file handles routing using a switch statement. Here's an example:

```php
switch($page){
  case "dashboard":
    $summary = $sbn->SusuModule("summary",false,BNK);
    $totalUser = isNull($summary['TotalUser']);
    $totalDeposit =isNull($summary['TotalDeposit']) ;
    $totalWithdraw = isNull($summary['TotalWithdraw']);
    $Balance = isNull($summary['Balance']);
    $datasheet = $sbn->SusuModule("currentTransaction",false,BNK);
    require("./frame/dashboard.php");
  break;
}
```

This example shows how to route to the `dashboard.php` template file for the "dashboard" page and retrieves data using the `SusuModule` function.

## Web Interface Development

To create a web interface:

1. Develop HTML, CSS, and JavaScript files in the `view/` directory.
2. Use JavaScript libraries like Axios to make SOAP requests to your server.
3. Handle server responses and update the user interface accordingly.

## Desktop Application Integration

To integrate Rabbit with a desktop application framework (e.g., Electron, Qt, JavaFX):

1. Develop your desktop application using your chosen framework.
2. Implement logic to make SOAP requests to your Rabbit framework server.
3. Handle responses from the server and update the desktop application's UI.

## Running the Application

1. Start your web server (e.g., built-in server, Nginx, or Apache).
2. Place your Rabbit framework directory in the web server's document root.
3. Access your application in the web browser using the configured host and port (e.g., http://localhost:8000).
