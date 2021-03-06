<?php

namespace App\Tests\Controller;

/**
 * @Route("/admin")
 */
class RepositoryControllerTest extends AbstractAppControllerTest
{
    /**
     * @Route("/repositories", name="repositories")
     */
    public function testIndex()
    {
        $this->client->request('GET', '/admin/repositories');

        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleSame('Repositories');
    }

    /**
     * @Route("/repositories/create/{type}", name="repositories_create")
     */
    public function testCreateFs()
    {
        $this->client->request('GET', '/admin/repositories/create/fs');

        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleSame('Repositories - Create Shared file system repository');
    }

    public function testCreateS3()
    {
        $this->client->request('GET', '/admin/repositories/create/s3');

        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleSame('Repositories - Create AWS S3 repository');
    }

    public function testCreateGcs()
    {
        $this->client->request('GET', '/admin/repositories/create/gcs');

        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleSame('Repositories - Create Google Cloud Storage repository');
    }

    /**
     * @Route("/repositories/{repository}", name="repositories_read")
     */
    public function testRead404()
    {
        $this->client->request('GET', '/admin/repositories/'.uniqid());

        $this->assertResponseStatusCodeSame(404);
    }

    /**
     * @Route("/repositories/{repository}/update", name="repositories_update")
     */
    public function testUpdate404()
    {
        $this->client->request('GET', '/admin/repositories/'.uniqid().'/update');

        $this->assertResponseStatusCodeSame(404);
    }
}
