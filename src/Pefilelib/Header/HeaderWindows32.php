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

class HeaderWindows32 extends HeaderBase {

	/**
	 *
	 */
	protected function initHeader() {
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('baseOfData', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('imageBase', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sectionAlignment', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('fileAlignment', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('majorOSVersion', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('minorOSVersion', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('majorImageVersion', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('minorImageVersion', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('majorSubsystemVersion', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('minorSubsystemVersion', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('win32VersionValue', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sizeOfImage', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sizeOfHeaders', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('checkSum', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('subsystem', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('dllCharacteristics', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sizeOfStackReserve', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sizeOfStackCommit', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sizeOfHeapCommit', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('loaderFlags', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('numberOfRvaAndSizes', HeaderFieldType::ULONGL()));
	}
	
}