<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 13/11/15
 * Time: 10:39
 */

namespace Test;


use Assetic\Asset\AssetCollection;
use Assetic\Asset\GlobAsset;
use Assetic\AssetManager;
use Assetic\AssetWriter;
use Assetic\Factory\AssetFactory;
use Assetic\Factory\Worker\CacheBustingWorker;
use Assetic\Filter\UglifyJs2Filter;
use Assetic\FilterManager;
use Interfaces\TestInterface;

class MainTest implements TestInterface
{
    public function runTest()
    {
        $this->testOne();

        $this->testTwo();

        $this->testThree();

        $this->testFoor();

        $this->testFive();
    }

    public function testOne()
    {
        $uglify = new UglifyJs2Filter("/usr/bin/uglifyjs", "/usr/bin/node");

        $uglify->setCompress(true);

        $uglify->setMangle(true);

        $uglify->setCompress(true);

        $js = new AssetCollection(array(
            new GlobAsset(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."assets/src/*", array(
                $uglify
            ))
        ));

        echo $js->dump();

        echo PHP_EOL;
    }

    public function testTwo()
    {
        $uglify = new UglifyJs2Filter("/usr/bin/uglifyjs", "/usr/bin/node");

        $uglify->setCompress(true);

        $uglify->setMangle(true);

        $uglify->setCompress(true);

        $am = new AssetManager();

        $am->set("app", new AssetCollection(array(
            new GlobAsset(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."assets/src/*", array(
                $uglify
            ))
        )));

        echo $am->get("app")->dump();

        echo PHP_EOL;
    }

    public function testThree()
    {
        $factory = $this->factoryAf();

        $js = $factory->createAsset(
               array(
                   "assets/src/*"
               ),
               array(
                   "uglify"
               )
        );
/**
        $am = new AssetManager();

        $am->set("app", new AssetCollection(array(
            new GlobAsset(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."assets/src/*", array(
                $uglify
            ))
        )));

        echo $am->get("app")->dump();
*/

        echo $js->dump();
        echo PHP_EOL;
    }

    protected function factoryAf()
    {
        $uglify = new UglifyJs2Filter("/usr/bin/uglifyjs", "/usr/bin/node");

        $uglify->setCompress(true);

        $uglify->setMangle(true);

        $uglify->setCompress(true);

        $factory = new AssetFactory(__DIR__."/../");

        $filterManager = new FilterManager();

        $filterManager->set("uglify", $uglify);

        $factory->setFilterManager($filterManager);

        return $factory;
    }

    protected function factoryAm()
    {
        $am = new AssetManager();

        return $am;
    }

    public function testFoor()
    {
        $am = $this->factoryAm();

        $writer = new AssetWriter(__DIR__."/../assets/build");

        $writer->writeManagerAssets($am);
    }

    public function testFive()
    {
        $factory = $this->factoryAf();

        $factory->addWorker(new CacheBustingWorker());

    }

    public function testSix()
    {

    }

}