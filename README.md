# bfs-php



Requires PHP 7.0+

## Docs
    Поиск по графу
    
## Install
    composer.json
    {
      "minimum-stability": "dev",
      "type": "project",
      "repositories": [
        {
          "type": "vcs",
          "url": "https://github.com/areut-su/php-graph.git"
        }
      ],
      "require": {
        "areut/php-graph": "dev-master"
      }
    }
   

## Examples
        <?php
        
        $graph = include( __DIR__ . '/graph2.php' );
        $m     = GraphBFS::create( StorageArray::create( $graph ) );
        $m->initFirstPath( false );
        $path = $m->path( 1, 1 );
        print_r($path);	


## Tests



## License


