<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router {
  protected $routes = [];

  /**
   * add new route
   * @param string $method
   * @param string $uri
   * @param string $action
   * @return void
   */
  public function registerRoute($method, $uri, $action) {
    list($controller, $controllerMethod) = explode("@", $action);

    $this->routes[] = [
      "method" => $method,
      'uri' => $uri,
      'controller' => $controller,
      "controllerMethod" => $controllerMethod
    ];
  }

  /**
   * get route
   * 
   * @param string uri
   * @param string $controller
   * @return void
   */
  public function get($uri, $controller) {
    $this->registerRoute("GET", $uri, $controller);
  }
  /**
   * post route
   * 
   * @param string uri
   * @param string $controller
   * @return void
   */
  public function post($uri, $controller) {
    $this->registerRoute("POST", $uri, $controller);
  }
  /**
   * put route
   * 
   * @param string uri
   * @param string $controller
   * @return void
   */
  public function put($uri, $controller) {
    $this->registerRoute("PUT", $uri, $controller);
  }
  /**
   * delete route
   * 
   * @param string uri
   * @param string $controller
   * @return void
   */
  public function delete($uri, $controller) {
    $this->registerRoute("DELETE", $uri, $controller);
  }

  /**
   * route the request
   * 
   * @param string $uri
   * @param string $method
   * @return void
   */
  public function route($uri,) {

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    // check for _method input
    if ($requestMethod === "POST" && isset($_POST['_method'])) {
      // override the request method with the value of _method
      $requestMethod = strtoupper($_POST['_method']);
    }


    foreach ($this->routes as $route) {
      // split the current uri
      $uriSegments = explode("/", trim($uri, "/"));

      // split the current route
      $routeSegments = explode("/", trim($route['uri'], "/"));

      $math = true;

      // check if numbers of segments matches & http method
      if (count($routeSegments) === count($uriSegments) && strtoupper($route['method']) === $requestMethod) {
        $params = [];

        $match = true;

        for ($i = 0; $i < count($uriSegments); $i++) {
          // if the uri does not match and there is no param
          if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
            $match = false;
            break;
          }

          // check for params and add to $params array
          if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
            $params[$matches[$i]] = $uriSegments[$i];
          }
        }

        if ($match) {
          // extract controller and controllerMethod
          $controller = "App\\Controllers\\" . $route['controller'];
          $controllerMethod = $route['controllerMethod'];

          // instantiate the controller and call the method
          $controllerInstance = new $controller();
          $controllerInstance->$controllerMethod($params);
          return;
        }
      }
    }

    // if not found, simply load error page
    ErrorController::notFound();
  }
}
