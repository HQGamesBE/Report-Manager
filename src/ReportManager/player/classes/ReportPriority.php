<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\ReportManager\player\classes;
use pocketmine\utils\EnumTrait;


/**
 * Class ReportPriority
 * @package HQGames\ReportManager\player\classes
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 19:07
 * @ide PhpStorm
 * @project Report-Manager
 *
 * @method static ReportPriority LOW()
 * @method static ReportPriority MEDIUM()
 * @method static ReportPriority HIGH()
 * @method static ReportPriority CRITICAL()
 */
class ReportPriority{
	use EnumTrait {
		__construct as Enum___construct;
	}


	/**
	 * Function setup
	 * @return void
	 */
	protected static function setup(): void{
		self::registerAll(
			new self("low", "%report.priority.low"),
			new self("medium", "%report.priority.medium"),
			new self("high", "%report.priority.high"),
			new self("critical", "%report.priority.critical"),
		);
	}

	/**
	 * ReportPriority constructor.
	 * @param string $name
	 * @param string $language_key
	 */
	private function __construct(
		string $name,
		private string $language_key
	){
		$this->Enum___construct($name);
	}

	/**
	 * Function language_key
	 * @return string
	 */
	public function language_key(): string{
		return $this->language_key;
	}

	public function getNextPriority(): ReportPriority{
		$index = array_search($this, self::getAll());
		if ($index === false || $index === (count(self::getAll()) -1))
			return self::getAll()[count(self::getAll()) - 1];

		return self::getAll()[$index + 1];
	}
}
