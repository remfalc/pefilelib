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

namespace Pefilelib\Section\Resource;

use Pefilelib\Section;

class ResourcesSection extends Section {

	private $directoryTree;

	private $dataDescriptionTable;

	private $stringTable;

	private $dataTable;

	
	
	protected function doDecode($buffer) {
		$this->directoryTree = new ResourceDirectory($this);
		$this->directoryTree->decode($buffer);

		var_dump($this->dataDescriptionTable[0]->dataRva);
		var_dump($this->resolveRawPointer(array_shift(array_keys($this->stringTable))));
		var_dump($this->resolveRvaPointer(array_shift(array_keys($this->dataTable))));
// 				var_dump(array_keys($this->dataTable));
	}
	
	protected function doEncode(){
		
	}

	public function addDataDescription(ResourceDataEntry $dataDescription) {
		$this->dataDescriptionTable[] = $dataDescription;
	}

	public function &resolveString($buffer, $offset) {

		fseek($buffer, $this->resolveRawPointer($offset));
		$nameLength = array_shift(unpack('C', fread($buffer, 1))) * 2; // Multiply by 2 because strings are unicode 2 bytes aligned

		$this->stringTable[$offset] = fread($buffer, $nameLength);

		// 		echo mb_detect_encoding($this->stringTable[$offset])."<br/>";

		return $this->stringTable[$offset];
	}

	public function &resolveData($buffer, $rvaOffset, $size) {

		fseek($buffer, $this->resolveRvaPointer($rvaOffset));
		$this->dataTable[$rvaOffset] = fread($buffer, $size);

		return $this->dataTable[$rvaOffset];
	}

	public function resolveRvaPointer($rvaOffset) {
		return $rvaOffset - $this->sectionHeader->getRvaToRawOffset();
	}

	public function resolveRawPointer($offset) {
		return $this->getHeaderField('pointerToRawData') + $offset;
	}

	public function getDirectoryTree() {
		return $this->directoryTree;
	}

}
