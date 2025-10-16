<?php
// script_drop_indexes.php
$db = new mysqli('localhost:1000', 'root', 'password', 'econnection_dev');

// Récupérer tous les index
$result = $db->query("
    SELECT TABLE_NAME, INDEX_NAME
    FROM INFORMATION_SCHEMA.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME IN ('connection_request', 'request_attachment')
    AND INDEX_NAME != 'PRIMARY'
    GROUP BY TABLE_NAME, INDEX_NAME
");

// Supprimer chaque index
while ($row = $result->fetch_assoc()) {
    $sql = "ALTER TABLE {$row['TABLE_NAME']} DROP INDEX {$row['INDEX_NAME']}";
    try {
        $db->query($sql);
        echo "✅ Supprimé: {$row['TABLE_NAME']}.{$row['INDEX_NAME']}\n";
    } catch (Exception $e) {
        echo "⚠️  Erreur: {$row['INDEX_NAME']} - {$e->getMessage()}\n";
    }
}

echo "\n🎯 Tous les index ont été traités!\n";