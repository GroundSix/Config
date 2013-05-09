<?php
namespace GroundSix\Config;

class Merger
{
	public function merge(ConfigurationsCollection $configurations)
	{
		throw new \Exception('Not implemented');
		if (0 == count($configurations)) {
			throw new \Exception('No configurations were found');
		}
		// reverse the array of configurations, because we want to push user ones on top of the master
		$configurations = array_reverse($configurations->getConfigurations());

		// we can now merge these arrays, 
		$result = call_user_func_array('array_merge_recursive', $configurations);
		if(0 == count($configurations)) {
			//
		} elseif (1 == count($configurations)) {
			return $configurations->pop();
		} else {
			return $this->mergeMultipleConfigurations($configurations);
		}
	}

	protected function mergeMultipleConfigurations(ConfigurationsCollection $configurations)
	{
		$master = $configurations->pop();
		foreach ($configurations as $configuration) {
			foreach ($configuration as $key => $value) {

			}
		}
	}

	protected function traverseAndOverrideMaster($configuration, $key_stack = array())
	{
		foreach ($configuration as $key => $value) {
			$key_stack[] = $key;
			if (is_array($value)) {
				$this->traverse($value, $key_stack);
			} else {
				$this->overrideMaster($key_stack, $value);
			}
		}
	}

	protected function overrideMaster($key_stack, $value)
	{
		if (1 == count($key_stack)) {
			$this->master[$key_stack[0]] = $value;
		} else {

		}
	}

}