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

final class HeaderMSDOS extends HeaderBase {
	
	const MAGIC = 'MZ';
	
	protected function initHeader() {
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('magic', HeaderFieldType::NULSTRING(), 2));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('lastSize', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('pagesInFile', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('relocations', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('headerSizeInParagraph', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('minExtraParagraphNeeded', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('maxExtraParagraphNeeded', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('initialSS', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('initialSP', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('checksum', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('initialIP', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('initialCS', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('fileAddOfRelocaTable', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('overlayNumber', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('reserved1', HeaderFieldType::NULSTRING(), 8));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('oemIdentifier', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('oemInformation', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('reserved2', HeaderFieldType::NULSTRING(), 20));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('peOffset', HeaderFieldType::ULONGL()));
	}

}
