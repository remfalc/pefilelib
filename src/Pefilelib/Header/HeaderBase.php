<?php
/**
 * Copyright 2013 Remy Falco
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author rfalco
 *
 */

namespace Pefilelib\Header;

abstract class HeaderBase {

	const PE_TYPE_UINT = '';

	private $staticFieldDefinitions;

	private $fieldValues;

	public function __construct() {
		$this->staticFieldDefinitions = array();
		$this->fieldValues = array();

		$this->initHeader();
	}

	private function getDecodeFormatString() {

		$format = '';
		foreach ($this->staticFieldDefinitions as $staticFieldDefinitions) {
			$format .= $staticFieldDefinitions->getType() . ($staticFieldDefinitions->getCount() == 1 ? null : $staticFieldDefinitions->getCount()) . $staticFieldDefinitions->getName() . '/';
		}
		return rtrim($format, '/');
	}
	
	protected function addStaticFieldDefinition(HeaderFieldDefinition $fieldDef) {
		$this->staticFieldDefinitions[] = $fieldDef;
	}
	
	protected function addDynamicFieldDefinition(HeaderFieldDefinition $fieldDef) {
		
	}
	
	protected function postDecode($buffer){ }
	
	protected function preEncode() { }

	public function decode($stream) {

// 		var_dump($this->getFormatString());
		
		if ($data = fread($stream, $this->getSize())) {
			$this->fieldValues = unpack($this->getDecodeFormatString(), $data);
		} else {
			//TODO Throw an Exception
			throw new Exception('Unable to read data');
		}
		
// 		echo "Decoding ".get_class($this).nl2br("\n\n");
		
// 		var_dump($this->fieldValues);
		
		$bufferPosition = ftell($stream);
		
		$this->postDecode($stream);
		
		if($bufferPosition != ftell($stream)){
			fseek($stream, $bufferPosition);
		}
	}
	
	public function encode(){
		$buffer = '';
		
		$this->preEncode();
		
		foreach($this->staticFieldDefinitions as $staticFieldDefinitions) {
			$format = $staticFieldDefinitions->getType().($staticFieldDefinitions->getCount() == 1 ? null : $staticFieldDefinitions->getCount());
			$value = $this->fieldValues[$staticFieldDefinitions->getName()];
			
			$buffer .= pack($format, $value);
		}
		
		return $buffer;
	}
	
	public function isValid(){
		return true;
	}

	public function __get($name) {
		if (array_key_exists($name, $this->fieldValues))
			return $this->fieldValues[$name];
	}

	public function __set($name, $value) {
		if (array_key_exists($name, $this->fieldValues))
			$this->fieldValues[$name] = $value;
	}

	public function __isset($name) {
		return (array_key_exists($name, $this->fieldValues) && isset($this->fieldValues[$name]));
	}

	/**
	 * Return the size of the header int byte
	 */

	public function getSize() {

		$size = 0;
		foreach ($this->staticFieldDefinitions as $fieldDefinition) {
			$size += $fieldDefinition->getSize();
		}

		return $size;
	}

	/**
	 * Initialize the header definition
	 * @return void
	 */

	protected abstract function initHeader();
	
}
