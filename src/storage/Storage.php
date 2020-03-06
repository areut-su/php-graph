<?php

namespace areutGraph\storage;

interface Storage {
	public function getNodeLink( int $node ): array;
}