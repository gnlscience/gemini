<?php
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On'); */

// include all controllers here
require('./controller/ContactController.php');
require('./controller/ContactTypeController.php');

function getArgumentStart($uri)
{
    foreach ($uri as $key => $value) {
        if ($value == 'index.php') {
            if ($key == count($uri) - 1) {
                return -1;
            }
            return $key + 1;
        }
    }
}


function main()
{
    $uri = parse_url($_SERVER['REQUEST_URI']);

    $parameters = explode('/', $uri['path']);
    // get query using $uri['query'] // TODO
    $start = getArgumentStart($parameters);
    if ($start != -1) {
        $controller_name = $parameters[$start];

        $function_name = $parameters[$start + 1]."_".strtolower($_SERVER['REQUEST_METHOD']);
        $start += 2;
        $args = array();
        for (; $start < count($parameters); $start++) {
            array_push($args, $parameters[$start]);
        }

        $controller_name = ucfirst($controller_name).'Controller';
        call_user_func_array(array(new $controller_name, $function_name), $args);
    } else {
        echo "404 not found";
    }
}

main();

?>
