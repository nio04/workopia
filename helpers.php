<?php

/**
 * get the base path
 * 
 * @param string $path
 * @return string
 */
function basePath($path = '') {
  return __DIR__ . '/' . $path;
}

/**
 * load a view
 * 
 * @param string $name
 * @return void
 */
function loadView($name) {
  $viewPath = require basePath("views/{$name}.view.php");

  if (file_exists($viewPath)) {
    require $viewPath;
  } else {
    echo "view {$name} not found!";
  }
}

/**
 * load partials
 * 
 * @param string $name
 * @return void
 */
function loadPartials($name) {
  $partialPath =  basePath("views/partials/{$name}.php");

  if (file_exists($partialPath)) {
    require $partialPath;
  } else {
    echo "partial {$name} is not found";
  }
}
