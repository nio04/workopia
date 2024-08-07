<?php

namespace Framework;

class Router {
  protected $routes = [];

  /**
   * add new route
   * @param string $method
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function registerRoute($method, $uri, $controller) {
    $this->routes[] = [
      "method" => $method,
      'uri' => $uri,
      'controller' => $controller
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
   * load error page
   * 
   * @param int $httpCode
   * @return void
   */
  public function error($httpCode = 404) {

    http_response_code($httpCode);
    loadView("error/{$httpCode}");
    exit;
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
        require basePath('App/' . $route['controller']);
        return;
      }
    }

    // if not found, simply load error page
    $this->error();
  }
}
