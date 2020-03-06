<?php

namespace areutGraphTest;

use areutGraph\GraphBFS;
use areutGraph\storage\StorageArray;
use PHPUnit\Framework\TestCase;

class BFSTest extends TestCase {


	public function testBFSPathLoopNF() {
		$graph = include( __DIR__ . '/graph1.php' );

		$m = GraphBFS::create( StorageArray::create( $graph ) );
		$m->initFirstPath( false );
		$path = $m->path( 1, 1 );
//		print_r( $path );
		$this->assertCount( 0, $path );

	}

	public function testBFSPath() {
		$graph = include( __DIR__ . '/graph2.php' );
		$m     = GraphBFS::create( StorageArray::create( $graph ) );
		$m->initFirstPath( false );
		$path = $m->path( 1, 11 );
//		print_r( $path );
		$this->assertCount( 4, $path );

	}

	public function testBFSPathLoop() {
		$graph = include( __DIR__ . '/graph2.php' );
		$m     = GraphBFS::create( StorageArray::create( $graph ) );
		$m->initFirstPath( false );
		$path = $m->path( 1, 1 );
		$this->assertCount( 7, $path );
		$m->reset();
		$path = $m->path( 5, 5 );
		$this->assertCount( 4, $path );
	}

	public function testBFSPathLoopFirst() {
		$graph = include( __DIR__ . '/graph2.php' );
		$m     = GraphBFS::create( StorageArray::create( $graph ) );
		$path  = $m->path( 1, 1 );
		$this->assertCount( 1, $path );
		$m->reset();
		$m->initFirstPath( false );
		$path = $m->path( 1, 1 );
		$this->assertCount( 7, $path );
	}

	public function testBFSPathVisited() {
		$graph = include( __DIR__ . '/graph2.php' );

		$m = GraphBFS::create( StorageArray::create( $graph ) );
		$m->initFirstPath( false );
		$path       = $m->path( 1, 3 );
		$visitedNot = array_diff( array_keys( $graph ), $m->getVisited() );

		$this->assertEquals( 7, reset( $visitedNot ) );
		$this->assertCount( 1, $visitedNot );
		$this->assertCount( 1, $path );

	}

}
