<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\network\protocol;
use HQGames\network\CloudPacket;
use HQGames\network\IPacketHandler;


/**
 * Class ReportSolvePacket
 * @package HQGames\network\protocol
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 20:25
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportSolvePacket extends CloudPacket{
	/**
	 * Function getPacketType
	 * @return string
	 */
	public static function getPacketType(): string{
		return "ReportSolve";
	}

	/**
	 * Function handle
	 * @param IPacketHandler $handler
	 * @return void
	 */
	public function handle(IPacketHandler $handler): void{
		$handler->handleReportSolvePacket($this);
	}
}
