<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump\world;

use pocketmine\Server;
use pocketmine\utils\Process;

class WorldsDump implements \JsonSerializable{
	public function __construct(
		protected Server $server
	){}

	public function jsonSerialize(): mixed{
		$worldDumps = [];
		foreach($this->server->getWorldManager()->getWorlds() as $world){
			$worldDumps[] = new WorldDump($world);
		}
		return $worldDumps;
	}
}