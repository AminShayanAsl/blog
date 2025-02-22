<?php

require_once __DIR__ . '/vendor/autoload.php';
use App\Models\Migration;
use config\Database;

Migration::createMigrationsTable();

$pdo = Database::getInstance();

$executedMigrations = [];
$result = $pdo->query("SELECT migration FROM migrations");
foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $executedMigrations[] = $row['migration'];
}

$migrationFiles = array_reverse(glob(__DIR__ . "/src/Migrations/*.php"));

foreach ($migrationFiles as $file) {
    $migrationName = basename($file, ".php");

    if (!in_array($migrationName, $executedMigrations)) {
        require_once $file;
        $className = "App\Migrations\\" . str_replace(" ", "", ucwords(str_replace("_", " ", $migrationName)));

        $obj = new $className();
        $obj->up();
        $pdo->prepare("INSERT INTO migrations (migration) VALUES (:migration)")
            ->execute([':migration' => $migrationName]);
        echo "Executed migration: $migrationName\n";
    }
}
