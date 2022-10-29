<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump\world;

use pocketmine\block\tile\Tile;
use pocketmine\block\tile\TileFactory;

class WorldTileDump implements \JsonSerializable{
	public function __construct(
		protected Tile $tile,
		protected int $count
	){}

	public function jsonSerialize(): mixed{
		return [
			"type" => TileFactory::getInstance()->getSaveId(get_class($this->tile)),
			"class" => get_class($this->tile),
			"count" => $this->count,
		];
	}
}