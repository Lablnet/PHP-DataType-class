<?php 
	/**
	 * This Package can convert datatypes
	 *
	 * @author   Malik Umer Farooq <lablnet01@gmail.com>
	 * @author-profile https://www.facebook.com/malikumerfarooq01/
	 * @license MIT 
	 *
	 * @link https://github.com/Lablnet/PHP-DataType-class
	 *
	 */

class DataType
{

		/**
		 * Convert arrays to Object
		 *
		 * @param array $array Arrays
		 *
		 * @return object
		 */
	public static function ArrayObject($array){

		if(is_array($array)){

			$object = new stdClass();

			foreach ($array as $key => $value){

				if(is_array($value)){

					$object->$key = DataType::ArrayObject($value);

				}else{

			    	$object->$key = $value;

				}

			}

			return (object) $object;

		}else{

			return false;

		}

	}
		/**
		 * Convert Objects to arrays
		 *
		 * @param object $object
		 *
		 * @return array
		 */
	public static function ObjectArray($object) {

		if(is_object($object)){

  			$reflectionClass = new ReflectionClass(get_class($object));

		    $array = [];

		    foreach ($reflectionClass->getProperties() as $property) {

		        $property->setAccessible(true);

		        $array[$property->getName()] = $property->getValue($object);

		        $property->setAccessible(false);

		    }

		    return $array;

		}else{

			return false;

		}	  

	}

		/**
		 * Convert XML to arrays
		 *
		 * @param xml object $xml xml
		 *
		 * @return array
		 */
	public static function XmlArray($xml){

		$dom = simplexml_load_file($xml);

		$json_encode = json_encode($dom);

		$json_decode = json_decode($json_encode,true);

		return $json_decode;

	}	

}