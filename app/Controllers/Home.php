<?php

namespace App\Controllers;

use App\Models\ConnectionModel;

class Home extends BaseController
{
    /**
     * 🚀 Index ultra-optimisé avec cache intelligent
     * Performance: < 10ms avec cache, 50-200ms sans cache
     */
    public function index()
    {
        helper('multi_language');
        session();
        (new Language())->initLocale($this->request->getLocale());

        $model = new ConnectionModel();
        $perPage = 10;

        // 📝 Récupération et nettoyage des paramètres
        $search = trim($this->request->getGet('search') ?? '');
        $page = (int)($this->request->getGet('page') ?? 1);

        // 🔑 Clé de cache optimisée (v4 = nouvelle version)
        $cacheKey = sprintf('req_v4_%s_p%d', md5($search), $page);
        $cache = \Config\Services::cache();

        // 🔍 Tentative de récupération du cache
        // if ($data = $cache->get($cacheKey)) {
        //     // ✅ Cache hit - ultra-rapide (< 10ms)
        //     return view('welcome_message', $data);
        // }

        // ⏱️ Cache miss - exécuter la requête
        $startTime = microtime(true);

        try {
            $data = [
                'requests' => $model->getRequestsWithAttachments($search, $perPage),
                'pager' => $model->pager,
                'search' => $search,
            ];

            $queryTime = round((microtime(true) - $startTime) * 1000, 2);

            // 📊 Cache adaptatif selon le type de recherche
            $ttl = $this->getCacheTTL($search);
            $cache->save($cacheKey, $data, $ttl);

            // 📝 Log de performance (uniquement en développement)
            if (ENVIRONMENT === 'development') {
                log_message('info', sprintf(
                    "Page loaded: %dms | Search: '%s' | Page: %d | Results: %d | Cache: %ds",
                    $queryTime,
                    $search,
                    $page,
                    count($data['requests']),
                    $ttl
                ));
            }

        } catch (\Exception $e) {
            // 🚨 Gestion d'erreur
            log_message('error', 'Database error: ' . $e->getMessage());
            
            // Retourner une page vide plutôt que de crasher
            $data = [
                'requests' => [],
                'pager' => null,
                'search' => $search,
                'error' => 'Une erreur est survenue. Veuillez réessayer.',
            ];
        }

        return view('welcome_message', $data);
    }

    /**
     * 🕐 Calcul du TTL de cache adaptatif
     * 
     * @param string $search Terme de recherche
     * @return int TTL en secondes
     */
    private function getCacheTTL(string $search): int
    {
        // Page d'accueil (sans recherche) : 3 minutes
        if (empty($search)) {
            return 180;
        }

        // Recherche par Work Request (stable) : 30 minutes
        if (preg_match('/^WR\d+/i', $search)) {
            return 1800;
        }

        // Recherche par liste de WR (,;) : 20 minutes
        if (preg_match('/[,;]/', $search)) {
            return 1200;
        }

        // Recherche par numéro exact (CNI, NIU, contrat) : 15 minutes
        if (preg_match('/^\d+$/', $search) && strlen($search) > 5) {
            return 900;
        }

        // Autres recherches (nom, etc.) : 5 minutes
        return 300;
    }

    /**
     * 🗑️ Méthode pour vider le cache (utile pour admin)
     * URL: /clear-cache?key=votre_secret
     */
    public function clearCache()
    {
        // 🔐 Protection stricte
        $secret = $this->request->getGet('key');
        
        if (!$secret || $secret !== getenv('CACHE_CLEAR_KEY')) {
            log_message('warning', 'Unauthorized cache clear attempt from IP: ' . $this->request->getIPAddress());
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Unauthorized']);
        }

        $cache = \Config\Services::cache();
        
        try {
            // Nettoyer tous les caches de requêtes (versions v3 et v4)
            $cleared = 0;
            $patterns = ['req_v3_', 'req_v4_', 'requests_'];
            
            // Nettoyer les 100 premières pages pour chaque pattern
            for ($i = 1; $i <= 100; $i++) {
                foreach ($patterns as $pattern) {
                    // Essayer différentes combinaisons de recherche
                    foreach (['', 'wr', 'test', 'a', 'b', 'c'] as $searchPrefix) {
                        $key = sprintf('%s%s_p%d', $pattern, md5($searchPrefix), $i);
                        if ($cache->delete($key)) {
                            $cleared++;
                        }
                    }
                }
            }

            // Aussi nettoyer le cache général si configuré
            if (method_exists($cache, 'clean')) {
                $cache->clean();
            }

            log_message('info', sprintf(
                'Cache cleared: %d entries | IP: %s',
                $cleared,
                $this->request->getIPAddress()
            ));

            return $this->response->setJSON([
                'success' => true,
                'cleared' => $cleared,
                'message' => 'Cache vidé avec succès',
                'timestamp' => date('Y-m-d H:i:s')
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Cache clear error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Erreur lors du vidage du cache',
                'message' => ENVIRONMENT === 'development' ? $e->getMessage() : 'Internal error'
            ]);
        }
    }

    /**
     * 📊 Méthode de diagnostic (désactivée en production par défaut)
     * URL: /diagnostics?key=votre_secret
     * 
     * Pour activer en production: définir ALLOW_DIAGNOSTICS=true dans .env
     */
    public function diagnostics()
    {
        // 🔐 Protection stricte en production
        if (ENVIRONMENT === 'production' && !getenv('ALLOW_DIAGNOSTICS')) {
            return $this->response->setStatusCode(404);
        }

        $secret = $this->request->getGet('key');
        if (!$secret || $secret !== getenv('CACHE_CLEAR_KEY')) {
            log_message('warning', 'Unauthorized diagnostics access attempt from IP: ' . $this->request->getIPAddress());
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();

        try {
            // Statistiques des tables
            $stats = $db->query("
                SELECT 
                    table_name,
                    table_rows,
                    ROUND(data_length / 1024 / 1024, 2) AS data_mb,
                    ROUND(index_length / 1024 / 1024, 2) AS index_mb
                FROM information_schema.tables
                WHERE table_schema = DATABASE()
                AND table_name IN ('connection_request', 'request_attachment')
            ")->getResultArray();

            // Index disponibles
            $indexes = $db->query("
                SELECT 
                    table_name,
                    index_name,
                    GROUP_CONCAT(column_name ORDER BY seq_in_index) as columns,
                    cardinality
                FROM information_schema.statistics
                WHERE table_schema = DATABASE()
                AND table_name IN ('connection_request', 'request_attachment')
                AND index_name != 'PRIMARY'
                GROUP BY table_name, index_name
            ")->getResultArray();

            // Test de performance
            $testStart = microtime(true);
            $db->query("SELECT COUNT(*) FROM connection_request WHERE deleted_at IS NULL");
            $testTime = round((microtime(true) - $testStart) * 1000, 2);

            log_message('info', 'Diagnostics accessed by IP: ' . $this->request->getIPAddress());

            return $this->response->setJSON([
                'success' => true,
                'tables' => $stats,
                'indexes' => $indexes,
                'count_query_time_ms' => $testTime,
                'cache_driver' => get_class(\Config\Services::cache()),
                'environment' => ENVIRONMENT,
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Diagnostics error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Internal error']);
        }
    }
}