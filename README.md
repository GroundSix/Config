# Ground Six Configuration Component

This component allows you to merge a number of configuration files together. Typically you may use a .gitignore so that all developers in your team can maintain their own development-environment-specific settings, however this approach allows you to keep a version controlled configuration file which contains the structure and shared contents, and each developer can override their own settings in a seperate file which they control.

The resulting merged configuration will be an array.

## Installation

Add the project to your composer.json file

	{
	    "require": {
	        "groundsix/config": "dev-master"
	    }
	}
Install the project

	php composer.phar update

## Usage

	require_once(__DIR__.'/vendor/autoload.php');
    $xml_loader = new \GroundSix\Config\XmlLoader(new \GroundSix\Config\ConfigurationsCollection());
    $xml_loader->loadFiles(__DIR__.'/config1.xml', __DIR__.'/config2.xml');
    $merger = new \GroundSix\Config\Merger();
    $config = $merger->merge($xml_loader->getConfigurations());

## Example

#### Config 1

	<?xml version="1.0" ?>
	<settings>
	    <application>
	        <template_set>twig</template_set>
	        <environment>production</environment>
	    </application>
	    <notice>
	        <enabled>true</enabled>
	    </notice>
	    <databases>
	        <mysql>
	            <user>production</user>
	        </mysql>
	    </databases>
	    <search>
	        <period>31536000</period>
	    </search>
	    <payments>
	        <sandbox>0</sandbox>
	        <methods>
	            <provider_a>
	                <app_id>A</app_id>
	                <app_secret>S</app_secret>
	                <merchant_id>M</merchant_id>
	                <access_token>T</access_token>
	            </provider_a>
	        </methods>
	    </payments>
	</settings>

### Config 2

	<?xml version="1.0" ?>
	<settings>
	    <application>
	        <environment>staging</environment>
	    </application>
	    <databases>
	        <mysql>
	            <user>staging</user>
	        </mysql>
	    </databases>
	    <payments>
	        <sandbox>1</sandbox>
	        <methods>
	            <provider_a>
	                <app_id>A2</app_id>
	                <app_secret>S2</app_secret>
	                <merchant_id>M2</merchant_id>
	                <access_token>T2</access_token>
	            </provider_a>
	        </methods>
	    </payments>
	</settings>

#### Merged config

	Array
	(
	    [application] => Array
	        (
	            [template_set] => twig
	            [environment] => staging
	        )
	    [notice] => Array
	        (
	            [enabled] => true
	        )
	    [databases] => Array
	        (
	            [mysql] => Array
	                (
	                    [user] => staging
	                )
	        )
	    [search] => Array
	        (
	            [period] => 31536000
	        )
	    [payments] => Array
	        (
	            [sandbox] => 1
	            [methods] => Array
	                (
	                    [provider_a] => Array
	                        (
	                            [app_id] => A2
	                            [app_secret] => S2
	                            [merchant_id] => M2
	                            [access_token] => T2
	                        )
	                )
	        )
	)