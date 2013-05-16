<?php
namespace GroundSix\Config;

class XmlLoader extends Loader
{
	public function loadFile($file_path)
	{
		$file_contents = simplexml_load_file($file_path);
		if (false == $file_contents) {
			throw new \Exception('Configuration file ' . $file_path . ' not found');
		}
		$this->addConfiguration($this->convertSimpleXmlElementToArray($file_contents));
	}

	protected function convertSimpleXmlElementToArray(\SimpleXMLElement $configuration)
	{
		$configuration = (array) $configuration;
		$resulting_array = $configuration;
		foreach ($configuration as $key => $value) {
			if ($value instanceOf \SimpleXMLElement) {
				$resulting_array[$key] = $this->convertSimpleXmlElementToArray($value);
			}
		}
		return $resulting_array;
	}
}