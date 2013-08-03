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

namespace Pefilelib;

use Pefilelib\Header;
use Pefilelib\Section;
use Pefilelib\Section\Resource;

class PeFile {

	private $headerMSDos;
	
	private $headerMSDosCode;

	private $headerCoff;

	private $headerCoffOptional;

	private $headerWindows;

	private $imageDataDirectories;

	private $sectionTable;

	public function __construct() {
		$this->headerMSDos = new HeaderMSDOS();
		$this->headerCoff = new HeaderCOFF();
		$this->sectionTable = new SectionTable();
	}

	public function load($file) {

		$buffer = fopen($file, 'rb');

		$this->headerMSDos->decode($buffer);

		$this->headerMSDosCode = fread($buffer, $this->headerMSDos->peOffset - ftell($buffer));
		
// 		echo strlen($this->headerMSDosCode);
		
// 		fseek($buffer, $this->headerMSDos->peOffset);

		$this->headerCoff->decode($buffer);

		if ($this->headerCoff->sizeOfOptionalHeader > 0) {
			$this->headerCoffOptional = new HeaderCOFFOptional();
			$this->headerCoffOptional->decode($buffer);

			switch ($this->headerCoffOptional->magic) {
				case 0x10B:
					$this->headerWindows = new HeaderWindows32();
					$this->headerWindows->decode($buffer);
					break;
			}
		}

		$this->imageDataDirectories = fread($buffer, $this->headerCoff->sizeOfOptionalHeader - $this->headerCoffOptional->getSize() - $this->headerWindows->getSize());

		//Decode section table
		$this->sectionTable->decode($buffer, $this->headerCoff->numberOfSection);
	}
	
	public function save($file){
		
// 		$buffer = fopen($file, 'wb');
		
		echo bin2hex($this->headerMSDos->encode());
		
	}

	public function getSectionTable() {
		return $this->sectionTable;
	}

}
