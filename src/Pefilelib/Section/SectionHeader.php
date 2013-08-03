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

namespace Pefilelib\Section;

class SectionHeader extends HeaderBase {
	
	protected function initHeader() {
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('name', HeaderFieldType::NULSTRING(), 8));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('virtualSize', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('virtualAddress', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sizeOfRawData', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('pointerToRawData', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('pointerToRelocation', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('pointerToLineNumbers', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('numberOfRelocations', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('numberOfLineNumbers', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('characteristics', HeaderFieldType::ULONGL()));
	}
	
	public function getRvaToRawOffset(){
		return $this->virtualAddress - $this->pointerToRawData;
	}
	
}