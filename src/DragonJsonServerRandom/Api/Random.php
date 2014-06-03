<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerRandom
 */

namespace DragonJsonServerRandom\Api;

/**
 * API Klasse für die Verwaltung von Zufallszahlen
 */
class Random
{
    use \DragonJsonServer\ServiceManagerTrait;

    /**
     * Gibt ein zufälliges Passwort zurück
     * @return string
     */
    public function getPassword()
    {
        $serviceManager = $this->getServiceManager();

        $password = $serviceManager->get('Config')['dragonjsonserverrandom']['password'];
        return $serviceManager->get('\DragonJsonServerRandom\Service\Random')
            ->getString($password['length'], $password['charset']);
    }
}
