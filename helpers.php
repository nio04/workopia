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
function loadView($name, $data = []) {
  $viewPath = basePath("App/views/{$name}.view.php");

  if (file_exists($viewPath)) {
    extract($data);
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
  $partialPath =  basePath("App/views/partials/{$name}.php");

  if (file_exists($partialPath)) {
    require $partialPath;
  } else {
    echo "partial {$name} is not found";
  }
}

/**
 * inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value) {
  echo "<pre>";
  var_dump($value);
  echo "</pre>";
}

/**
 * inspect a value(s) and die
 * 
 * @param mixed $value
 * @return void
 */
function dd($value) {
  echo "<pre>";
  var_dump($value);
  echo "</pre>";
  die;
}

/**
 * format salary
 * 
 * @param string $salary
 * @return string $formattedSalary
 */
function formatSalary($salary) {
  return "$" . number_format(floatval($salary));
}

/**
 * sanitize data
 * 
 * @param string $dirty
 * @return string 
 */
function sanitize($dirty) {
  return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

function redirect($url) {
  header("Location: {$url}");
  exit;
}
