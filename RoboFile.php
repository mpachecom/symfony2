<?php
// RoboFile.php

class RoboFile extends \Robo\Tasks
{

    public $basedir = __DIR__;

    public function build()
    {
        $this->prepare();
        $this->behat();
    }

    public function prepare()
    {

        $dirs = array(
            "build/behat",
            "build/logs/behat"
        );

        $task = $this->taskExecStack()->stopOnFail();

        foreach ($dirs as $dir) {
            $task->exec("mkdir -p {$dir}");
        }

        $task->run();

        $this->taskComposerInstall()
            ->optimizeAutoloader()
            ->run();

        $this->npm();

        $this->taskExec('app/console assets:install')->run();
        $this->taskExec('app/console assetic:dump')->run();

    }

    private function npm()
    {
        $this->taskExec('npm')->arg("install")->run();
    }

    private function behat()
    {

        $this->taskExec('./node_modules/.bin/phantomjs --webdriver=4444 --webdriver-loglevel=WARNING')
            ->background()
            ->run();

        $this->taskExec('app/console server:run 127.0.0.1:8000')
            ->background()
            ->run();

        //$this->taskExec('./bin/behat -c app/config/behat.yml')
        //    ->run();

        //$this->taskExec('bin/behat')
        //    ->run();
    }
}