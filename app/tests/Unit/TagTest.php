<?php

// namespace Tests\Unit;

// use tests\TestCase;
use Illuminate\Foundation\Testing\TestCase;
// use PHPUnit\Framework\TestCase;
// use app\tests\TestCase;

// use modules\collaborative\models\Tag;
use Illuminate\Foundation\Testing\WithFazer;
use Illuminate\Foundatation\Testing\RefreshDatabase;

class TagUnitTest extends TestCase

{
	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */

	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		// return require __DIR__.'/../../../bootstrap/start.php';
    }

    private function prepareForTests()
    {
      Artisan::call('migrate');
    }

    public function setUp()
    {
      parent::setUp();
      $this->prepareForTests();
    }
  

    /** @test */
    public function testShouldCreateTag() {
        $all_tags = Tag::all();
        $result = Tag::getOrCreate('new_tag');
        $all_new_tags = Tag::all();
    
        $this->assertTrue( $all_tags->isEmpty() );
        $this->assertTrue( $result instanceof Tag );
        $this->assertEquals( 'new_tag', $result->name );
        $this->assertEquals( 1, $all_new_tags->count() );
      }

}