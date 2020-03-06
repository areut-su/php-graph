<?php

namespace areutGraph;

use areutGraph\storage\Storage;
use SplQueue;

class GraphBase {
	/**
	 * @var array
	 */
	private $visited;
	/**
	 * @var Storage;
	 */
	private $graph;
	/**
	 * @var SplQueue
	 */
	private $p_q;
	/**
	 * @var SplQueue  all path
	 */
	private $pf_q;

	private $first_path = true;


	public static function create( Storage $graph ) {
		$model          = new static();
		$model->graph   = $graph;
		$model->visited = [];
		$model->newPath();
		$model->newPathFound();

		return $model;
	}

	protected function newPath() {
		$this->p_q = new SplQueue();
	}

	protected function newPathFound() {
		$this->pf_q = new SplQueue();
	}

	static public function array_remove_val( array &$array, int $val ) {
		$key = array_search( $val, $array, true );
		if ( false !== $key ) {
			unset( $array[ $key ] );

			return true;
		}

		return false;

	}

	/**
	 * reset variable fo new search
	 */
	public function reset() {
		$this->visited = [];
		$this->newPath();
		$this->newPathFound();

	}

	/**
	 * масив всех посещенных точек
	 * @return array
	 */
	public function getVisited(): array {
		return array_keys( $this->visited );
	}

	/**
	 * @param int $visited
	 *
	 * харнит все посещаемые узлы в ключах
	 *
	 */
	protected function setVisited( int $visited ) {
		$this->visited[ $visited ] = null;
	}

	/**
	 * true - find All path
	 * false - find First path
	 * @return bool
	 */
	public function firstPath(): bool {
		return $this->first_path;
	}

	/**
	 * true - find All path
	 * false - find First path
	 *
	 * @param bool $first_path
	 *
	 * @return void
	 */
	public function initFirstPath( bool $first_path ) {
		$this->first_path = $first_path;
	}


	protected function pathEnqueue( array $value ) {
		$this->p_q->enqueue( $value );


	}

	/**
	 * @param array $value
	 */
	protected function pathFindEnqueue( array $value ) {
		$this->pf_q->enqueue( $value );

	}

	protected function getNode( int $node ): array {
		return $this->graph->getNodeLink( $node );
	}

	protected function pathDequeue(): array {
		return $this->p_q->dequeue();
	}


	protected function getCountPath(): int {
		return $this->getPaths()->count();
	}

	/**
	 * @return SplQueue
	 */
	protected function getPaths(): SplQueue {
		return $this->p_q;
	}

	/**
	 * @return SplQueue
	 */
	protected function getPathsFind(): SplQueue {
		return $this->pf_q;
	}

}