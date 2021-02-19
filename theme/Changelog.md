### Changelog

## Version 1.0.0 (17 January 2019)

## 19 June 

- Removed bootstrao datepicker npm uninstall bootstrap-datepicker
- npm uninstall fullcalendar
- npm uninstall chart.js
- npm uninstall gmaps
-  commented following libraries in app.js to reduce the unnecessary files and reduce the main.js size
	//'./src/scripts-init/calendar.js',
    //'./src/scripts-init/maps.js',
    //'./src/scripts-init/charts/chartjs.js',
- Commented out the pages.js so the main.css and main.js can be directly copied to laravel public directory 
- remove delete CleanWebpackPlugin option from wepack.config.helper.js this will be required when we directly write to publi directory    

To Do 
move css js and images font directly to public folder
