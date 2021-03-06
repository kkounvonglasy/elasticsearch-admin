<?php

namespace App\Tests\Controller;

/**
 * @Route("/admin")
 */
class SnapshotControllerTest extends AbstractAppControllerTest
{
    /**
     * @Route("/snapshots", name="snapshots")
     */
    public function testIndex()
    {
        $this->client->request('GET', '/admin/snapshots');

        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleSame('Snapshots');
    }

    /**
     * @Route("/snapshots/create", name="snapshots_create")
     */
    public function testCreate()
    {
        $this->client->request('GET', '/admin/snapshots/create');

        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleSame('Snapshots - Create snapshot');
    }

    /**
     * @Route("/snapshots/{repository}/{snapshot}", name="snapshots_read")
     */
    public function testRead404()
    {
        $this->client->request('GET', '/admin/snapshots/'.uniqid().'/'.uniqid());

        $this->assertResponseStatusCodeSame(404);
    }

    /**
     * @Route("/snapshots/{repository}/{snapshot}/restore", name="snapshots_read_restore")
     */
    public function testRestore404()
    {
        $this->client->request('GET', '/admin/snapshots/'.uniqid().'/'.uniqid().'/restore');

        $this->assertResponseStatusCodeSame(404);
    }
}
