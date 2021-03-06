<?php

namespace App\Controller;

use App\Controller\AbstractAppController;
use App\Model\CallRequestModel;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin")
 */
class LicenseController extends AbstractAppController
{
    /**
     * @Route("/license", name="license")
     */
    public function read(Request $request): Response
    {
        $callRequest = new CallRequestModel();
        $callRequest->setPath('/_xpack/license');
        $callResponse = $this->callManager->call($callRequest);
        $license = $callResponse->getContent();
        $license = $license['license'];

        $callRequest = new CallRequestModel();
        $callRequest->setPath('/_xpack/license/trial_status');
        $callResponse = $this->callManager->call($callRequest);
        $trialStatus = $callResponse->getContent();
        $trialStatus = $trialStatus['eligible_to_start_trial'];

        $callRequest = new CallRequestModel();
        $callRequest->setPath('/_xpack/license/basic_status');
        $callResponse = $this->callManager->call($callRequest);
        $basicStatus = $callResponse->getContent();
        $basicStatus = $basicStatus['eligible_to_start_basic'];

        $callRequest = new CallRequestModel();
        $callRequest->setPath('/_xpack');
        $callResponse = $this->callManager->call($callRequest);
        $xpack = $callResponse->getContent();

        return $this->renderAbstract($request, 'Modules/license/license_read.html.twig', [
            'license' => $license,
            'trial_status' => $trialStatus,
            'basic_status' => $basicStatus,
            'xpack' => $xpack,
        ]);
    }

    /**
     * @Route("/license/start/trial", name="license_start_trial")
     */
    public function startTrial(Request $request): Response
    {
        $callRequest = new CallRequestModel();
        $callRequest->setMethod('POST');
        $callRequest->setPath('/_xpack/license/start_trial');
        $callRequest->setQuery(['acknowledge' => 'true']);
        $callResponse = $this->callManager->call($callRequest);

        $this->addFlash('info', json_encode($callResponse->getContent()));

        return $this->redirectToRoute('license');
    }

    /**
     * @Route("/license/start/basic", name="license_start_basic")
     */
    public function startBasic(Request $request): Response
    {
        $callRequest = new CallRequestModel();
        $callRequest->setMethod('POST');
        $callRequest->setPath('/_xpack/license/start_basic');
        $callRequest->setQuery(['acknowledge' => 'true']);
        $callResponse = $this->callManager->call($callRequest);

        $this->addFlash('info', json_encode($callResponse->getContent()));

        return $this->redirectToRoute('license');
    }
}
