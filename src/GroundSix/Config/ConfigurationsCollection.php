<?php
namespace GroundSix\Config;

class ConfigurationsCollection implements \Countable, \IteratorAggregate
{
	protected $configurations = array();

	public function add($configurations)
	{
		if (!is_array($configurations)) {
			throw new \Exception('Processed configurations are not an array');
		}
		$this->configurations[] = $configurations;
	}

	public function getIterator()
    {
        return new \ArrayIterator($this->configurations);
    }

    public function count()
    {
        return count($this->configurations);
    }

    public function pop()
    {
    	$configuration = $this->configurations[0];
    	unset($this->configurations[0]);
    	return $configuration;
    }

    public function getConfigurations()
    {
    	return $this->configurations;
    }
}