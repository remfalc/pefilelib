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



class ResourceDirectoryEntry extends HeaderBase {

	private $parent;

	private $name;

	private $type;

	private $value;

	public function __construct(ResourceDirectory $parent) {
		parent::__construct();

		$this->parent = $parent;
		$this->name = null;
		$this->type = ResourceDirectoryEntryType::RESOURCE_DIRECTORY;
		$this->value = null;
	}

	protected function initHeader() {
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('id', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('offset', HeaderFieldType::ULONGL()));
	}

	protected function postDecode($buffer) {

		if (($this->id & 0x80000000) != 0) {
			$this->name = &$this->parent->getParentSection()->resolveString($buffer, $this->id & (~0x80000000));
		}

		if (($this->offset & 0x80000000) == ResourceDirectoryEntryType::RESOURCE_DATA) {

			// 			var_dump(($this->offset));
			// 			var_dump($this->parent->getParentSection()->resolveRawPointer($this->offset));
			$this->value = new ResourceDataEntry($this->parent);
			$this->parent->getParentSection()->addDataDescription($this->value);
		} else {
			$this->offset &= ~0x80000000;
			$this->value = new ResourceDirectory($this->parent->getParentSection());
		}

		fseek($buffer, $this->parent->getParentSection()->resolveRawPointer($this->offset));
		$this->value->decode($buffer);
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function getType() {
		return $this->type;
	}

}
