<?php
namespace App\Framework;

class Route
{
  protected $action;
  protected $url;
  protected $paramsNames;
  protected $params = [];

  public function __construct($url,  $action, array $paramsNames)
  {
    $this->setUrl($url);
    $this->setAction($action);
    $this->setVarsNames($paramsNames);
  }

  public function hasParams()
  {
    return !empty($this->paramsNames);
  }

  public function match($url)
  {
    if (preg_match('`^'.$this->url.'$`', $url, $matches))
    {
      return $matches;
    }
    else
    {
      return false;
    }
  }

  public function setAction($action)
  {
    if (is_string($action))
    {
      $this->action = $action;
    }
  }

  public function setModule($module)
  {
    if (is_string($module))
    {
      $this->module = $module;
    }
  }

  public function setUrl($url)
  {
    if (is_string($url))
    {
      $this->url = $url;
    }
  }

  public function setVarsNames(array $varsNames)
  {
    $this->varsNames = $varsNames;
  }

  public function setVars(array $vars)
  {
    $this->vars = $vars;
  }

  public function action()
  {
    return $this->action;
  }

  public function module()
  {
    return $this->module;
  }

  public function vars()
  {
    return $this->vars;
  }

  public function varsNames()
  {
    return $this->varsNames;
  }
}