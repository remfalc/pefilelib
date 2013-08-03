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

class SectionTable {

	private $tableEntries;

	private $sections;

	public function __construct() {
		$this->tableEntries = array();
		$this->sections = array();
	}

	public function decode($buffer, $numberOfEntry) {

		for ($i = 0; $i < $numberOfEntry; $i++) {
			$entry = new SectionHeader();
			$entry->decode($buffer);

			$this->tableEntries[] = $entry;
		}

		foreach ($this->tableEntries as $key => $sectionHeader) {
			if (!array_key_exists($key, $this->sections)) {
				
// 				echo "Decoding section: ".$sectionHeader->name.nl2br("\n");
				
				// Resolve section type and decode the section
				$section = SectionBuilder::createSection($sectionHeader);				
				$section->decode($buffer);

				$this->sections[$key] = $section;
			}
		}
	}

	public function getCount() {
		return count($this->tableEntries);
	}

	public function getSectionByName($name) {

		foreach ($this->tableEntries as $key => $tableEntry) {
			if ($tableEntry->name == $name) {
				if (array_key_exists($key, $this->sections)) {
					return $this->sections[$key];
				}
			}
		}
		return null;
	}

}
