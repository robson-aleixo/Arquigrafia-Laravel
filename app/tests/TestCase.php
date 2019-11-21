<?php
// use PHPUnit\Framework\TestCase;

// namespace app\tests;

class TestCase extends Illuminate\Foundation\Testing\TestCase {
// class TesteCase extends TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */

	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	public function setUp()
	{
		parent::setUp();
		$this->resetEvents();
	}

	 /**
     * Flush and reboot Eloquent model events.
     * 
     * @return void
     */
    public function resetEvents()
    {
        foreach ($this->getModels() as $model)
        {
            call_user_func([$model, 'flushEventListeners']);
            
            call_user_func([$model, 'boot']);
        }
    }
    
    /**
     * Get the model names from their filename.
     * 
     * @return array
     */
    protected function getModels()
    {
        $files = File::files(base_path() . '/app/models');
        
        foreach ($files as $file)
        {
            $models[] = pathinfo($file, PATHINFO_FILENAME);
        }
        
        return $models;
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
