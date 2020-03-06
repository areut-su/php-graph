<?php

namespace areutGraph\storage;

class StorageArray implements Storage {
	private $graph_array;

	public static function create( array &$graph ): self {
		$m              = new self;
		$m->graph_array = $graph;

		return $m;
	}

	public function getNodeLink( int $node ): array {
		return $this->graph_array[ $node ];
	}


}