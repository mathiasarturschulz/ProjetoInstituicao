<?php

spl_autoload_register(function ($nomeClasse) {
  if (file_exists("classes".DIRECTORY_SEPARATOR.$nomeClasse.".class.php"))
    require_once("classes".DIRECTORY_SEPARATOR.$nomeClasse.".class.php");
});

spl_autoload_register(function ($nomeClasse) {
  if (file_exists("classesDAO".DIRECTORY_SEPARATOR.$nomeClasse.".class.php"))
    require_once("classesDAO".DIRECTORY_SEPARATOR.$nomeClasse.".class.php");
});

spl_autoload_register(function ($nomeClasse) {
  if (file_exists("conexao".DIRECTORY_SEPARATOR.$nomeClasse.".class.php"))
    require_once("conexao".DIRECTORY_SEPARATOR.$nomeClasse.".class.php");
});

spl_autoload_register(function ($nomeClasse) {
  if (file_exists("graficos".DIRECTORY_SEPARATOR.$nomeClasse.".class.php"))
    require_once("graficos".DIRECTORY_SEPARATOR.$nomeClasse.".class.php");
});

spl_autoload_register(function ($nomeClasse) {
  if (file_exists("helpers".DIRECTORY_SEPARATOR.$nomeClasse.".php"))
    require_once("helpers".DIRECTORY_SEPARATOR.$nomeClasse.".php");
});

