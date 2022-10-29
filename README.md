# Server Dump

Run /dd to dump the server. This is useful for debugging entities, tiles and players in the server.

## Example Output

```json
{
  "uptime": "2 hours 22 minutes 22 seconds",
  "tps": 20.0,
  "chunks": 224,
  "memory": {
    "main-thread": "70.37 MB",
    "total": "70.37 MB",
    "total-virtual": "84.00 MB"
  },
  "players": [
    {
      "name": "xerenahmed",
      "uuid": "867a9682-f6ee-3c7c-ae33-1638eb56a8ab",
      "ping": 12,
      "view-distance": 8,
      "world-folder-name": "lobby"
    }
  ],
  "worlds": [
    {
      "folder-name": "xerenahmed-normal-island",
      "chunks": 186,
      "entites": [
        {
          "type": "minecraft:zombie",
          "class": "\\pocketmine\\entity\\Zombie",
          "count": 12
        }
      ],
      "tiles": [
        {
          "type": "minecraft:chest",
          "class": "\\pocketmine\\block\\tile\\Chest",
          "count": 12
        }
      ]
    }
  ]
}
```

## Command options

| Option | Description                                                                  |
|--------|------------------------------------------------------------------------------|
| -o     | Specify full path to output file.                                            |
| -so    | Put dump content to plugin_data/ServerDump/server-dump.json                  |
| -sod   | Put dump content with datetime to plugin_data/ServerDump/server-dump-xx.json |
