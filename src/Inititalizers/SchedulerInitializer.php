<?php

declare(strict_types=1);

namespace Tempest\Console\Inititalizers;

use Tempest\Application;
use Tempest\Console\ConsoleApplication;
use Tempest\Console\Scheduler\GenericScheduler;
use Tempest\Console\Scheduler\NullScheduler;
use Tempest\Console\Scheduler\ScheduledInvocationExecutor;
use Tempest\Console\Scheduler\Scheduler;
use Tempest\Console\Scheduler\SchedulerConfig;
use Tempest\Container\Container;
use Tempest\Container\Initializer;
use Tempest\Container\Singleton;

#[Singleton]
final readonly class SchedulerInitializer implements Initializer
{
    public function initialize(Container $container): Scheduler
    {
        $application = $container->get(Application::class);

        if (! $application instanceof ConsoleApplication) {
            return new NullScheduler();
        }

        return new GenericScheduler(
            $container->get(SchedulerConfig::class),
            $container->get(ScheduledInvocationExecutor::class),
        );
    }
}
