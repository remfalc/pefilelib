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

class HeaderCOFFOptional extends HeaderBase {
	
	
	/**
	 * 
	 */
	protected function initHeader() {
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('magic', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('majorLinkerVersion', HeaderFieldType::UCHAR()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('minorLinkerVersion', HeaderFieldType::UCHAR()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sizeOfCode', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sizeOfInitializedData', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('sizeOfUninitializedData', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('addressOfEntryPoint', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('baseOfCode', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('baseOfData', HeaderFieldType::ULONGL()));
	}

}
