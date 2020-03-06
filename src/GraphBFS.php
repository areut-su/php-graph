<?php

namespace areutGraph;


use areutGraph\storage\Storage;
use SplQueue;

class GraphBFS extends GraphBase {
	public static function create( Storage $graph ) {
		return parent::create( $graph );
	}

	/**
	 * @param string $start start Node
	 * @param string $end finish Node
	 *  if loop => $start ==$end
	 * @param int $level_max мах link visited
	 *
	 * @return SplQueue
	 *
	 */
	public function path( int $start, int $end, $level_max = 100 ) {
		/**
		 * инциализируем очередь путей
		 */
		$this->pathEnqueue( [ $start ] );
		/**
		 * $visited - node  которые посетили, когда нашли path обновляем node; В конце работы не все node
		 */
		$visited = [];
		$level_i = 0;
		do {

			/**
			 * извлекаем первый элемент из очереди путей
			 */
			$path = $this->pathDequeue();
			$node = $path[ count( $path ) - 1 ];

			// у node  проверяем пути, если достигли то
			foreach ( $this->getNode( $node ) as $link ) {
				if ( ! in_array( $link, $visited ) ) {
					$visited[]  = $link;
					$new_path   = $path;
					$new_path[] = $link;
					$this->setVisited( $link );
//					$level_i > 0 &&
					if ( $link === $end ) {
						$this->pathFindEnqueue( $new_path );
						$visited = array_diff( $visited, $new_path );
						if ( $this->firstPath() ) {
							return $this->getPathsFind();
						}

					} else {

						/**
						 * проверка на зацикливание
						 */
						if ( ! in_array( $link, $path ) ) {
							$this->pathEnqueue( $new_path );

						}

					}
				}
			}
			$level_i ++;
//			print_r($this->getPaths());
		} while ( $level_i < $level_max && $this->getCountPath() > 0 );

		return $this->getPathsFind();
	}


}