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

final class HeaderFieldType {

	private $type;

	private $size;

	const NULSTRING = 'a';
	const HEXSTRINGL = 'h';
	const HEXSTRINGH = 'H';
	const CHAR = 'c';
	const UCHAR = 'C';
	const SHORT = 's';
	const USHORT = 'S';
	const USHORTB = 'n';
	const USHORTL = 'v';
	const INT = 'i';
	const UINT = 'I';
	const LONG = 'l';
	const ULONG = 'L';
	const ULONGB = 'N';
	const ULONGL = 'V';
	const FLOAT = 'f';
	const DOUBLE = 'd';

	private function __construct($type, $size) {
		$this->type = $type;
		$this->size = $size;
	}

	public static function NULSTRING() {
		return new HeaderFieldType(HeaderFieldType::NULSTRING, 1);
	}

// 	public static function HEXSTRINGL() {
// 		return new HeaderFieldType(HeaderFieldType::HEXSTRINGL, 1);
// 	}

// 	public static function HEXSTRINGH() {
// 		return new HeaderFieldType(HeaderFieldType::HEXSTRINGH, 1);
// 	}

	public static function CHAR() {
		return new HeaderFieldType(HeaderFieldType::CHAR, 1);
	}

	public static function UCHAR() {
		return new HeaderFieldType(HeaderFieldType::UCHAR, 1);
	}

	public static function SHORT() {
		return new HeaderFieldType(HeaderFieldType::SHORT, 2);
	}

	public static function USHORT() {
		return new HeaderFieldType(HeaderFieldType::USHORT, 2);
	}

	public static function USHORTB() {
		return new HeaderFieldType(HeaderFieldType::USHORTB, 2);
	}

	public static function USHORTL() {
		return new HeaderFieldType(HeaderFieldType::USHORTL, 2);
	}

	public static function INT() {
		return new HeaderFieldType(HeaderFieldType::INT, PHP_INT_SIZE);
	}

	public static function UINT() {
		return new HeaderFieldType(HeaderFieldType::UINT, PHP_INT_SIZE);
	}

	public static function LONG() {
		return new HeaderFieldType(HeaderFieldType::LONG, 4);
	}

	public static function ULONG() {
		return new HeaderFieldType(HeaderFieldType::ULONG, 4);
	}

	public static function ULONGB() {
		return new HeaderFieldType(HeaderFieldType::ULONGB, 4);
	}

	public static function ULONGL() {
		return new HeaderFieldType(HeaderFieldType::ULONGL, 4);
	}
	// 	public static function FLOAT() {
	// 		return new HeaderFieldType(HeaderFieldType::FLOAT);
	// 	}
	// 	public static function DOUBLE() {
	// 		return new HeaderFieldType(HeaderFieldType::DOUBLE);
	// 	}

	public function __toString() {
		return $this->type;
	}

	public function getType() {
		return $this->type;
	}

	public function getSize() {
		return $this->size;
	}

}
