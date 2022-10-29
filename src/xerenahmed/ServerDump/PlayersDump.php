<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump;

use pocketmine\Server;
use pocketmine\utils\Process;

class PlayersDump implements \JsonSerializable{
	public function __construct(
		protected Server $server
	){}

	public function jsonSerialize(): mixed{
		$usernames = [];
		$onlinePlayers = $this->server->getOnlinePlayers();
		foreach($onlinePlayers as $player){
			$usernames[] = [
				"name" => $player->getName(),
				"uuid" => $player->getUniqueId()->toString(),
				"ping" => $player->getNetworkSession()->getPing(),
				"view-distance" => $player->getViewDistance(),
				"world-folder-name" => $player->getWorld()->getFolderName(),
			];
		}

		return $usernames;
	}
}