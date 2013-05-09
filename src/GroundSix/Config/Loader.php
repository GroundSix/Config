<?php
namespace GroundSix\Config;

abstract class Loader
{
	protected $configurations;

	public function __construct(ConfigurationsCollection $configurations_collection)
	{
		$this->configurations = $configurations_collection;
	}

	public function loadFile($file_path);

	public function loadFiles()
	{
		$$configuration_file_paths = func_get_args();
		foreach ($configuration_file_paths as $config_file_path) {
			try {
				$this->loadFile($config_file_path);
			} catch (\Exception $e) {
				throw $e;
			}
		}
	}

	public function getConfigurations()
	{
		return $this->configurations;
	}

	protected function addConfiguration($configuration)
	{
		$this->configurations->add($configuration);
	}
}