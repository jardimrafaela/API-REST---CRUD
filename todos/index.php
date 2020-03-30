<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$_SERVER['REQUEST_METHOD'];

/*if($_SERVER['REQUEST_METHOD'] === 'GET'){require 'read_one.php';
    include 'http://api.rafaelajardim.kinghost.net/todos';
    }
*/
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET' :
        require 'read.php';
        include 'http://api.rafaelajardim.kinghost.net/todos';
        break;
    case 'POST':
        require 'create.php';
        include 'http://api.rafaelajardim.kinghost.net/todos';
        break;
    case 'DELETE':
        require 'delete.php';
        include 'http://api.rafaelajardim.kinghost.net/todos';
        break;
    case 'GET':
        require 'read_one.php';
        include 'http://api.rafaelajardim.kinghost.net/todos';
        break;
    case 'PUT':
        require 'update.php';
        include 'http://api.rafaelajardim.kinghost.net/todos';
        break;
}

/*if
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){require 'create.php';
include 'http://api.rafaelajardim.kinghost.net/todos';
}
if($_SERVER['REQUEST_METHOD'] === 'PUT'){require 'update.php';
include 'http://api.rafaelajardim.kinghost.net/todos';
}
if($_SERVER['REQUEST_METHOD'] === 'DELETE'){require 'delete.php';
include 'http://api.rafaelajardim.kinghost.net/todos';
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){require 'read_one.php';
include 'http://api.rafaelajardim.kinghost.net/todos';
}
*/


//funciona
// Ta funcionando todas as requisições na index

?>
