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

class HeaderFieldDefinition {

	private $name;

	private $type;

	private $count;

	private function __construct($name, HeaderFieldType $type, $count) {
		$this->name = $name;
		$this->type = $type;
		$this->count = $count;
	}

	public static function create($name, HeaderFieldType $type, $count = 1) {
		return new HeaderFieldDefinition($name, $type, $count);
	}

	public function getSize() {
		return $this->count * $this->type->getSize();
	}

	public function getName() {
		return $this->name;
	}

	public function getType() {
		return $this->type;
	}

	public function getCount() {
		return $this->count;
	}

}
