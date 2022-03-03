## Plugin for automatically creating a screenshot of the active theme

---

**The plugin does not require any settings.** You need to enable the plugin in the dashboard and use it.

The plugin adds a widget to the toolbar that allows you to get and save a screenshot of the main screen of the active theme.
The screenshot is obtained using the service googleapis.com

For security reasons, Google has set a limit on the number of requests to the server for one user. Maximum request frequency: 1 request per minute.

> The plugin does not work on local servers!

The button sometimes does not work the first time. Sometimes the server returns error 429, due to Google restrictions. Try to press the button again, after 30 seconds.

---

If you see such an error, it means that you do not have the **images** folder in **assets**. Create a folder and try again

```r
"imagepng(./themes/YOUR_THEME/assets/images/theme-preview.png): failed to open stream: No such file or directory" on line 74 of /home/x/user/your_site.ru/public_html/plugins/eugene3993/themepreview/reportwidgets/ScreenshotWidget.php
```

---

> Google Api technologies may change unexpectedly and the plugin may stop working if a **404 error** is displayed when updating the screenshot, please let me know.

---

> The plugin has not been tested on OctoberCMS v2.x

If you have any question about how to use this plugin, please don't hesitate to contact us. We're happy to help you.
- telegram: [@Eugene_Kul](https://t.me/eugene_kul)
- email: [gm742445004@gmail.com](mailto:admin@cloudhadoop.com)