<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump\world;

use pocketmine\world\World;
use function count;
use function get_class;

class WorldDump implements \JsonSerializable{
	public function __construct(
		protected World $world
	){}

	public function jsonSerialize(): mixed{
		$entities = [];
		foreach($this->world->getEntities() as $entity){
			$entities[get_class($entity)][] = $entity;
		}
		$entityDumps = [];
		foreach($entities as $class => $entityList){
			$entityDumps[] = new WorldEntityDump($entityList[0], count($entityList));
		}

		$tiles = [];
		foreach($this->world->getLoadedChunks() as $chunks){
			foreach($chunks->getTiles() as $tile){
				$tiles[get_class($tile)][] = $tile;
			}
		}
		$tileDumps = [];
		foreach($tiles as $class => $tileList){
			$tileDumps[] = new WorldTileDump($tileList[0], count($tileList));
		}

		return [
			"folder-name" => $this->world->getFolderName(),
			"chunks" => count($this->world->getLoadedChunks()),
			"entities" => $entityDumps,
			"tiles" => $tileDumps,
		];
	}
}
