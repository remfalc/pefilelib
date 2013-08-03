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

class ResourceDataEntry extends HeaderBase {
	
	private $parent;
	
	private $value;
	
	public function __construct(ResourceDirectory $parent){
		parent::__construct();
		
		$this->parent = $parent;
	}
	
	protected function initHeader(){
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('dataRva', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('size', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('codepage', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('reserved', HeaderFieldType::ULONGL()));
	}
	
	protected function postDecode($buffer){
		$this->value = $this->parent->getParentSection()->resolveData($buffer, $this->dataRva, $this->size);
	}
}
