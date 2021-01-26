<?php
  //Se incluye la configuración de conexión a datos en el
  //SGBD: MariaDB.
  require_once 'Model/database.php';
  //Para registrar productos es necesario iniciar los proveedores
  //de los mismos, por ello la variable controller para este
  //ejercicio se inicia con el 'proveedor'.
  $controller = 'login';
  // Todo esta lógica hara el papel de un FrontController
  if(!isset($_REQUEST['c']))
  {
	  session_start();  
 session_destroy();
    //Llamado de la página principal
    require_once "Controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();
  }
  else
  {
    // Obtiene el controlador a cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    // Instancia el controlador
    require_once "Controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    // Llama la accion
    call_user_func( array( $controller, $accion ) );
  }