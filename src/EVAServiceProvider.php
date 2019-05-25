<?php

namespace Squarebit\EVA;

use Illuminate\Support\ServiceProvider;

/**
 *
 */
class EVAServiceProvider extends ServiceProvider {

  /**
   *
   */
  public function boot() {
    if ($this->isLaravel() && $this->app->runningInConsole()) {
      $this->publishes([
        __DIR__ . '/../config/eva.php' => config_path('eva.php'),
      ], 'config');
    }

  }

  /**
   *
   */
  public function register() {
    if ($this->isLaravel()) {
      $this->mergeConfigFrom(__DIR__ . '/../config/eva.php', 'eva');
    }
  }

  /**
   *
   */
  protected function isLaravel() {
    return !preg_match('/lumen/i', app()->version());
  }

}
