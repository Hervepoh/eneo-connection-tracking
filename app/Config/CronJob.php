<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Daycry\CronJob\Scheduler;

class CronJob extends \Daycry\CronJob\Config\CronJob
{
    /**
     * Set true if you want save logs
     */
    public bool $logPerformance = true;

    /*
    |--------------------------------------------------------------------------
    | Log Saving Method
    |--------------------------------------------------------------------------
    |
    | Set to specify the REST API requires to be logged in
    |
    | 'file'   Save in files
    | 'database'  Save in database
    |
    */
    public string $logSavingMethod = 'database';

    /**
     * Directory
     */
    public string $filePath = WRITEPATH . 'cronJob/';

    /**
     * File Name in folder jobs structure
     */
    public string $fileName = 'jobs';

    /**
     * --------------------------------------------------------------------------
     * Maximum performance logs
     * --------------------------------------------------------------------------
     *
     * The maximum number of logs that should be saved per Job.
     * Lower numbers reduced the amount of database required to
     * store the logs.
     *
     * If you write 0 it is unlimited
     */
    public int $maxLogsPerJob = 0;

    /*
    |--------------------------------------------------------------------------
    | Database Group
    |--------------------------------------------------------------------------
    |
    | Connect to a database group for logging, etc.
    |
    */
    public string $databaseGroup = 'default';

    /*
    |--------------------------------------------------------------------------
    | Cronjob Table Name
    |--------------------------------------------------------------------------
    |
    | The table name in your database that stores cronjobs
    |
    */
    public string $tableName = 'cronjob';

    /*
    |--------------------------------------------------------------------------
    | Cronjobs
    |--------------------------------------------------------------------------
    |
    | Register any tasks within this method for the application.
    | Called by the TaskRunner.
    |
    | @param Scheduler $schedule
    */
    public function init(Scheduler $schedule)
    {
        // $schedule->command('foo:bar')->everyMinute();
        // $schedule->shell('cp foo bar')->daily( '11:00 pm' );
        // $schedule->shell('cp foo bar')->cron('0 */2 * * *'); every two Hours
        // $workdir = "C:\appStore\CI4\connection\connection\public";
        $workdir = "/var/www/connection.eneoapps.com/public_html/public"; //"/applications/www/html/connection.eneoapps.com/public"; 
	$index   = $workdir . DIRECTORY_SEPARATOR . "index.php";
	$crontab1 = '0 21 * * *';
	$crontab2 = '0 22 * * *';
	$crontab3 = '0 23 * * *';
	$crontab4 = '0 23 * * *';
	$crontab5 = '0 01 * * *';
	$crontab6 = '0 02 * * *';
	//$schedule->shell("php {$index} tasks")->cron($crontabtest)->named('tasks');
	$schedule->shell("php {$index} index")->cron($crontab1)->named('tasks_index');
	$schedule->shell("php {$index} attachment")->cron($crontab2)->named('tasks_attachment');
	$schedule->shell("php {$index} open")->cron($crontab3)->named('tasks_open');
	$schedule->shell("php {$index} index")->cron($crontab4)->named('tasks_index');
	$schedule->shell("php {$index} attachment")->cron($crontab5)->named('tasks_attachment');
	$schedule->shell("php {$index} open")->cron($crontab6)->named('tasks_open');
	//$schedule->shell("php {$index} tasks_update")->cron('*/5 * * * *')->named('tasks_update');
	//$schedule->shell("php {$index} attachment")->cron($crontabtest)->named('tasks_for_attachment_full');
	//$schedule->shell("php {$index} tasks_notify")->cron('* * * * *')->named('tasks_notify');
	//$schedule->shell("php {$index} tasks_update_user_information")->cron('0 0 1 * *')->named('tasks_update_user_information'); #every month

        // $schedule->call( function() { do something.... } )->everyMonday()->named( 'foo' )
    }
}
