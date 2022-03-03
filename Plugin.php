<?php namespace Eugene3993\ThemePreview;

use Backend;
use System\Classes\PluginBase;
use Eugene3993\ThemePreview\ReportWidgets\ScreenshotWidget;

class Plugin extends PluginBase {

   public function pluginDetails() {
      return [
         'name'        => 'eugene3993.themepreview::lang.plugin_name',
         'description' => 'eugene3993.themepreview::lang.plugin_description',
         'author'      => 'Eugene3993',
         'icon'        => 'icon-image'
      ];
   }

    public function registerReportWidgets() {
        return [
            ScreenshotWidget::class => [
                'label' => 'Theme Preview Screenshot',
                'context' => 'dashboard',
            ],
        ];
    }
}
