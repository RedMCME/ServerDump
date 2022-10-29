<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump;

use pocketmine\Server;
use xerenahmed\ServerDump\world\WorldsDump;

class DumpData implements \JsonSerializable{
	public function __construct(
		protected Server $server
	){}

	public function jsonSerialize(): mixed{
		$chunks = 0;
		foreach($this->server->getWorldManager()->getWorlds() as $world){
			$chunks += count($world->getLoadedChunks());
		}
		return [
			"uptime" => new UptimeDump($this->server),
			"tps" => $this->server->getTicksPerSecondAverage(),
			"chunks" => $chunks,
			"memory" => new MemoryDump($this->server),
			"players" => new PlayersDump($this->server),
			"worlds" => new WorldsDump($this->server),
		];
	}
}