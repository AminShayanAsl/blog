<?php

use config\Database;

$pdo = Database::getInstance();

$lastMigration = $pdo->query("SELECT migration FROM migrations ORDER BY id DESC LIMIT 1")->fetchColumn();

if ($lastMigration) {
    require_once __DIR__ . "/migrations/$lastMigration.php";
    $className = str_replace(" ", "", ucwords(str_replace("_", " ", $lastMigration)));

    if (class_exists($className)) {
        $className::down();
        $pdo->prepare("DELETE FROM migrations WHERE migration = :migration")
            ->execute([':migration' => $lastMigration]);
        echo "Migration was rolled back: $lastMigration\n";
    }
} else {
    echo "❌ هیچ مهاجرتی برای بازگردانی وجود ندارد.\n";
}
