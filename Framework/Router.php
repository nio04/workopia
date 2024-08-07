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
  public function route($uri, $method) {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === $method) {
        // extract controller and controllerMethod
        $controller = "App\\Controllers\\" . $route['controller'];
        $controllerMethod = $route['controllerMethod'];

        // instantiate the controller and call the method
        $controllerInstance = new $controller();
        $controllerInstance->$controllerMethod();
        return;
      }
    }

    // if not found, simply load error page
    ErrorController::notFound();
  }
}
