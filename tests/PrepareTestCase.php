<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

/**
 * 支持多库事务回滚
 * Trait MultipleDatabaseTransactions
 */
trait PrepareTestCase
{
    /**
     * 是否在测试后MigrateRollback
     * @var bool
     */
    public static $migrateRollbackWhenTearDown = true;

    /**
     * 需要回滚事务的数据库连接
     * @var array
     */
    protected $connectionsToTransact = ['mysql'];

    /**
     * Handle database transactions on the specified connections.
     *
     * @return void
     */
    public function beginDatabaseTransaction()
    {
        $database = $this->app->make('db');
        foreach ($this->connectionsToTransact() as $name) {
            $database->connection($name)->beginTransaction();
        }
        $this->beforeApplicationDestroyed(function () use ($database) {
            foreach ($this->connectionsToTransact() as $name) {
                $connection = $database->connection($name);

                $connection->rollBack();
                $connection->disconnect();
            }
        });
    }

    /**
     * The database connections that should have transactions.
     *
     * @return array
     */
    protected function connectionsToTransact()
    {
        return property_exists($this, 'connectionsToTransact')
            ? $this->connectionsToTransact : [null];
    }

    public function setUpTraits()
    {
        $uses = array_flip(class_uses_recursive(get_class($this)));

        if (isset($uses[DatabaseMigrations::class])) {
            throw new Error('数据表结构初始化已由TestCasePrepare托管');
        }
        if (isset($uses[DatabaseTransactions::class])) {
            throw new Error('事务管理结构初始化已由TestCasePrepare托管');
        }

        $this->beginDatabaseTransaction();
        parent::setUpTraits();
    }
}