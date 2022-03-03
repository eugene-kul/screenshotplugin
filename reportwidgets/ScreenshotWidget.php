<?php namespace Eugene3993\ThemePreview\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Cms\Classes\Theme;
use Flash;

class ScreenshotWidget extends ReportWidgetBase {
   
   public function defineProperties() {
      return [
         'imageHeight' => [
            'title' => 'eugene3993.themepreview::lang.image_height',
            'default' => '720',
            'type' => 'dropdown',
            'options' => [
               '600' => '600',
               '720' => '720',
               '768' => '768',
               '900' => '900',
               '960' => '960',
               '1024' => '1024',
            ]
         ]
      ];
   }

   public function render() {
      return $this->makePartial('default');
   }

   public function onScreenshot() {
      $domain = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
      $url_api = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$domain&screenshot=true";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, $url_api);
      $api_data = json_decode(curl_exec($ch), true);
      
      if (!curl_errno($ch)) {
         switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
         case 200:
            $this->saveImage($api_data);
            break;
         case 429:
            Flash::error("ERROR $http_code! " . e(trans('eugene3993.themepreview::lang.error_429')));
            break;
         default:
            Flash::error("ERROR $http_code! " . e(trans('eugene3993.themepreview::lang.later')));
            break;
         }
      } else {
         Flash::error(curl_error($ch));
      }
      curl_close($ch);

      return [
         'partial' => $this->render(),
      ];
   }

   public function saveImage($api_data) {
      $activeTheme = Theme::getActiveThemeCode();
      $filename = './themes/' . $activeTheme . '/assets/images/theme-preview.png';

      $screenshot = $api_data['lighthouseResult']['audits']['full-page-screenshot']['details']['screenshot']['data'];
      $screenshotWidth = $api_data['lighthouseResult']['audits']['full-page-screenshot']['details']['screenshot']['width'];
      $screenshot = substr($screenshot, 1+strrpos($screenshot, ','));
      $screenshot = imagecreatefromstring(base64_decode($screenshot));
      $screenshotCrop = imagecrop($screenshot, ['x' => 0, 'y' => 0, 'width' => $screenshotWidth, 'height' => $this->property('imageHeight')]);

      imagepng($screenshotCrop, $filename);

      Flash::success(e(trans('eugene3993.themepreview::lang.update')) . $filename);
   }
}
