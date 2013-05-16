<?php
namespace GroundSix\Config;

class Merger
{

	public function merge(ConfigurationsCollection $configurations)
	{
		$merged = null;
		foreach ($configurations as $configuration) {
			if (!is_null($merged)) {
				$merged = $this->mergeTwoConfigurations($merged, $configuration);
			} else {
				$merged = $configuration;
			}
		}
		return $merged;
	}

	protected function mergeTwoConfigurations($configuration_a, $configuration_b)
	{
		$merged = array();
		foreach ($configuration_a as $key => $value) {
			if (array_key_exists($key, $configuration_b)) {
				if (is_array($value)) {
					$merged[$key] = $this->mergeTwoConfigurations($configuration_a[$key], $configuration_b[$key]);
				} else {
					$merged[$key] = $configuration_b[$key];
				}
			} else {
				$merged[$key] = $value;
			}
		}
		return $merged;
	}

}