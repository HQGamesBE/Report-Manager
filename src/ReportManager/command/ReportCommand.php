<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\ReportManager\command;
use HQGames\Bridge\player\BridgePlayer;
use HQGames\Core\commands\commando\CommandoCommand;
use HQGames\ReportManager\ReportManager;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\types\command\CommandEnum;
use pocketmine\network\mcpe\protocol\types\command\CommandParameter;


/**
 * Class ReportCommand
 * @package HQGames\ReportManager\command
 * @author Jan Sohn / xxAROX
 * @date 24. July, 2022 - 00:01
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportCommand extends CommandoCommand{
	public function __construct(){
		parent::__construct("report", "Report players", "/report <notify|list>", ["rpt"], [
			[
				CommandParameter::enum("sub-command", new CommandEnum("notify", ["notify"]), self::FLAG_NORMAL, true),
				CommandParameter::enum("value", new CommandEnum("boolean", ["false","true"]), self::FLAG_NORMAL, true),
			],
			[
				CommandParameter::enum("sub-command", new CommandEnum("list", [ "list" ]), self::FLAG_NORMAL, true),
			]
		]);
	}

	/**
	 * Function onRun
	 * @param BridgePlayer|CommandSender $sender
	 * @param string $typedCommand
	 * @param array $args
	 * @return void
	 */
	protected function onRun(BridgePlayer|CommandSender $sender, string $typedCommand, array $args): void{
		if (isset($args[0])){
			switch ($args[0]){
				case "notify":
					if (isset($args[1])){
						$sender->getBridge()->getBackendProperties()->setReportNotify($args[1] === "true");
						$sender->sendMessage("§aSuccessfully set report notify to " . ($args[1] === "true" ? "§aenabled" : "§cdisabled") . "§a.");
					}
					break;
				case "list":
					if ($sender instanceof BridgePlayer){
						$sender->sendForm(new ReportManagerForm);
					}
					break;
				default:
					$sender->sendMessage("§cUnknown sub-command.");
					break;
			}
		} else {
			$sender->sendMessage("§cUsage: §f/report <notify|list>");
		}
	}
}
