<?php
namespace tests\Codec;

use Good\Gd\Codec;
use Good\UnitTest\UnitCase;

class PngCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle('Test case for Png Codec');
		$codec = Codec::factory('png');
		
		$mime  = $codec->getMimeType();	
		$this->assert("Mime type : $mime", $mime == 'image/png');
		
		$name = $codec->getName();
		$this->assert("Mime name : $name", $name == 'png');
		
		// decodage jpg
		$filename = '../public/images/image.jpg';
		$resource = $codec->decode($filename);		
		$this->assert("Décodage d'une image jpg", is_resource($resource));
		
		// encodage png
		$codec->encode($resource, '../tmp/image-encoded.png');
		$this->assert("Encodage en png", is_resource($resource));
		
		echo '<img src="../tmp/image-encoded.png" alt="Image générée" />';
		
	}
}