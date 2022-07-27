<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\ReportManager;
use HQGames\Bridge\Bridge;
use HQGames\network\protocol\ReportCreatePacket;
use HQGames\Permissions;
use HQGames\ReportManager\player\classes\Report;
use HQGames\ReportManager\player\classes\ReportPriority;
use HQGames\ReportManager\player\classes\ReportReason;
use JetBrains\PhpStorm\Pure;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\permission\Permission;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginDescription;
use pocketmine\plugin\PluginLoader;
use pocketmine\plugin\ResourceProvider;
use pocketmine\Server;
use pocketmine\utils\SingletonTrait;


/**
 * Class ReportManager
 * @package HQGames\ReportManager
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 18:57
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportManager extends PluginBase{
	use SingletonTrait{
		setInstance as private static;
		reset as private;
	}

	/** @var ReportReason[] */
	protected array $reasons = [];
	/** @var Report[] */
	protected array $unsolved_reports = [];


	/**
	 * ReportManager constructor.
	 * @param PluginLoader $loader
	 * @param Server $server
	 * @param PluginDescription $description
	 * @param string $dataFolder
	 * @param string $file
	 * @param ResourceProvider $resourceProvider
	 */
	public function __construct(PluginLoader $loader, Server $server, PluginDescription $description, string $dataFolder, string $file, ResourceProvider $resourceProvider){
		self::setInstance($this);
		parent::__construct($loader, $server, $description, $dataFolder, $file, $resourceProvider);
	}

	/**
	 * Function getOpenReports
	 * @return array
	 */
	public function getOpenReports(): array{
		return $this->unsolved_reports;
	}

	public function addReport(Report $report): void{
		$this->unsolved_reports[$report->getIdentifier()] = $report;
		Bridge::getInstance()->getCloudConnection()->sendPacket(ReportCreatePacket::build($report));
	}

	public function solveReport(Report $report): void{
		$report->setSolved(true);
		unset($this->unsolved_reports[$report->getIdentifier()]);
	}

	public function registerReason(string $language_key, string $priority): ReportReason{
		$priority = match (mb_strtolower($priority)) {
			ReportPriority::CRITICAL()->name() => ReportPriority::CRITICAL(),
			ReportPriority::HIGH()->name() => ReportPriority::HIGH(),
			ReportPriority::MEDIUM()->name() => ReportPriority::MEDIUM(),
			default => ReportPriority::LOW(),
		};
		$reason = new ReportReason(count($this->reasons), $language_key, $priority);
		$this->reasons[$reason->getId()] = $reason;
		return $reason;
	}
	public function unregisterReason(ReportReason $reason): void{
		unset($this->reasons[$reason->getId()]);
	}
	public function getReasonById(int $id): ?ReportReason{
		return $this->reasons[$id] ?? null;
	}
	#[Pure]
	public function getReasonByLangaugeKey(string $language_key): ?ReportReason{
		foreach ($this->reasons as $reason) {
			if ($reason->getReason() === $language_key)return $reason;
		}
		return null;
	}

	/**
	 * Function onLoad
	 * @return void
	 */
	public function onLoad(): void{
		$this->getLogger()->info("Loading...");
	}

	/**
	 * Function onEnable
	 * @return void
	 */
	public function onEnable(): void{
		Permissions::getInstance()->registerPermission(new Permission("hqgames.report.delete", "Delete reports"));
		Permissions::getInstance()->registerPermission(new Permission("hqgames.report.list", "List reports"));
		Permissions::getInstance()->registerPermission(new Permission("hqgames.report.notify", "Notify reports"));
		$this->registerCommands();
		$this->registerListeners();

		$this->getLogger()->info("Enabled");
	}

	/**
	 * Function onDisable
	 * @return void
	 */
	public function onDisable(): void{
		$this->getLogger()->info("Disabled");
	}

	/**
	 * Function registerCommands
	 * @return void
	 */
	private function registerCommands(): void{
		/** @var Command[] $commands */
		$commands = [
		];
		foreach ($commands as $command) $this->getServer()->getCommandMap()->register(mb_strtolower($this->getDescription()->getName()), $command);
	}

	/**
	 * Function registerListeners
	 * @return void
	 */
	private function registerListeners(): void{
		/** @var Listener[] $listeners */
		$listeners = [
		];
		foreach ($listeners as $listener) $this->getServer()->getPluginManager()->registerEvents($listener, $this);
	}
}
