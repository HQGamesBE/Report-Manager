<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\network;
use HQGames\network\protocol\ReportCreatePacket;
use HQGames\network\protocol\ReportSolvePacket;


/**
 * Interface IReportPacketHandler
 * @package HQGames\network
 * @author Jan Sohn / xxAROX
 * @date 27. July, 2022 - 17:05
 * @ide PhpStorm
 * @project Report-Manager
 */
interface IReportPacketHandler extends IPacketHandler{
	/**
	 * Function handleReportCreatePacket
	 * @param ReportCreatePacket $packet
	 * @return void
	 */
	public function handleReportCreatePacket(ReportCreatePacket $packet): void;

	/**
	 * Function handleReportSolvePacket
	 * @param ReportSolvePacket $packet
	 * @return void
	 */
	public function handleReportSolvePacket(ReportSolvePacket $packet): void;
}
