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

class ResourceDirectory extends HeaderBase {

	private $directoryEntriesHeader;

	private $directoryEntries;

	private $parentSection;

	public function __construct(ResourcesSection $section) {
		parent::__construct();
		$this->parentSection = $section;
	}

	protected function initHeader() {
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('characteristics', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('timeDateStamp', HeaderFieldType::ULONGL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('majorVersion', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('minorVersion', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('numberOfNameEntries', HeaderFieldType::USHORTL()));
		$this->addStaticFieldDefinition(HeaderFieldDefinition::create('numberOfIdEntries', HeaderFieldType::USHORTL()));
	}

	protected function postDecode($buffer) {

		$numberOfEntries = $this->numberOfNameEntries + $this->numberOfIdEntries;

		for ($i = 0; $i < $numberOfEntries; $i++) {
			$this->directoryEntries[$i] = new ResourceDirectoryEntry($this);
		}

		foreach ($this->directoryEntries as $key => $entry) {
			$entry->decode($buffer);
		}
	}

	public function resolveRawPointer($offset) {
		return $this->parentSection->resolveRawPointer($offset);
	}

	public function resolveRvaPointer($rvaOffset) {
		return $this->parentSection->resolveRvaPointer($rvaOffset);
	}

	public function getParentSection() {
		return $this->parentSection;
	}
	
	public function getEncodedSize(){
		
		$size = 0;
		foreach ($this->directoryEntries as $entry){
			$size += $entry->getSize();
			
			if($entry->getType() == ResourceDirectoryEntryType::RESOURCE_DIRECTORY)
				$size += $entry->getValue()->getEncodedSize();
		}
		
		return $size;
	}
	
	
}
