<?php
namespace App\Framework;


class Request 
{

	private $parameters;
	

	public function __construct($parameters)
	{
		$this->parameters = $parameters;
	
	}
	
	
	public function existsParameter($name)
	{
		return (!empty($this->parameters[$name]));
	}


	public function getParameter($name)
	{
		if ($this->existsParameter($name))
		{
			return htmlspecialchars($this->parameters[$name]);
		}
		else 
		{
			throw new \Exception("Paramètre '$name' absent de la requête");
		}
	}
}