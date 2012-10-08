<?php
namespace tests\Codec;

use Good\Gd\Codec;
use Good\UnitTest\UnitCase;

class GifCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle('Test case for Gif Codec');
		$codec = Codec::factory('gif');
		
		$mime  = $codec->getMimeType();	
		$this->assert("Mime type : $mime", $mime == 'image/gif');
		
		$name = $codec->getName();
		$this->assert("Mime name : $name", $name == 'gif');
		
		// decodage png
		$filename = '../public/images/image.jpg';
		$resource = $codec->decode($filename);		
		$this->assert("Décodage d'une image png", is_resource($resource));
		
		// encodage gif
		$codec->encode($resource, '../tmp/image-encoded.gif');
		$this->assert("Encodage en gif", is_resource($resource));
		
		echo '<img src="../tmp/image-encodedimage-encoded.gif" alt="Image générée" />';
		
	}
}