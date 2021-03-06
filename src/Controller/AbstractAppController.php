<?php

namespace App\Controller;

use App\Manager\CallManager;
use App\Manager\PaginatorManager;
use App\Model\CallRequestModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractAppController extends AbstractController
{
    public function __construct(CallManager $callManager, PaginatorManager $paginatorManager)
    {
        $this->callManager = $callManager;
        $this->paginatorManager = $paginatorManager;
    }

    public function renderAbstract(Request $request, string $view, array $parameters = [], Response $response = null): Response
    {
        $callRequest = new CallRequestModel();
        $callRequest->setPath('/_cluster/health');
        $callResponse = $this->callManager->call($callRequest);
        $clusterHealth = $callResponse->getContent();

        $parameters['cluster_health'] = $clusterHealth;

        $callRequest = new CallRequestModel();
        $callRequest->setPath('/_cat/master');
        $callResponse = $this->callManager->call($callRequest);
        $master = $callResponse->getContent();

        $parameters['master_node'] = $master[0]['node'] ?? false;

        $callRequest = new CallRequestModel();
        $callRequest->setPath('/_xpack');
        $callResponse = $this->callManager->call($callRequest);
        $xpack = $callResponse->getContent();

        $parameters['xpack_features'] = $xpack['features'];

        return $this->render($view, $parameters, $response);
    }
}
