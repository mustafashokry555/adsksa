const mix = require('laravel-mix');
const lodash = require("lodash");
const folder = {
    src: "/", // source files
    dist: "public/", // build files
    dist_assets: "public/assets/" //build assets files
};
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
 var third_party_assets = {
        css_js: [
            {"name": "jquery", "assets": ["./node_modules/jquery/dist/jquery.min.js"]},

        ]
    };

    //copying third party assets
    lodash(third_party_assets).forEach(function (assets, type) {
        if (type == "css_js") {
            lodash(assets).forEach(function (plugin) {
                var name = plugin['name'],
                    assetlist = plugin['assets'],
                    css = [],
                    js = [];
                lodash(assetlist).forEach(function (asset) {
                    var ass = asset.split(',');
                    for (let i = 0; i < ass.length; ++i) {
                        if(ass[i].substr(ass[i].length - 3)  == ".js") {
                            js.push(ass[i]);
                        } else {
                            css.push(ass[i]);
                        }
                    };
                });
                if(js.length > 0){
                    mix.combine(js, folder.dist_assets + "/libs/" + name + "/" + name + ".min.js");
                }
                if(css.length > 0){
                    mix.combine(css, folder.dist_assets + "/libs/" + name + "/" + name + ".min.css");
                }
                if(js.length > 0){
                    mix.combine(js, folder.dist_admin_assets + "/libs/" + name + "/" + name + ".min.js");
                }
                if(css.length > 0){
                    mix.combine(css, folder.dist_admin_assets + "/libs/" + name + "/" + name + ".min.css");
                }
                 if(js.length > 0){
                    mix.combine(js, folder.dist_pharmacy_assets + "/libs/" + name + "/" + name + ".min.js");
                }
                if(css.length > 0){
                    mix.combine(css, folder.dist_pharmacy_assets + "/libs/" + name + "/" + name + ".min.css");
                }
            });
        }
    });

    mix.copy('resources/fonts/fonts', 'public/assets/fonts');
    mix.copy('resources/fonts/fonts-admin', 'public/assets_admin/fonts');
    mix.copy('resources/fonts/fonts-pharmacy', 'public/assets_pharmacy/fonts');
    mix.copy('resources/img/img', 'public/assets/img');
    mix.copy('resources/img/img-admin', 'public/assets_admin/img');
    mix.copy('resources/img/img-pharmacy', 'public/assets_pharmacy/img');
    mix.copy('resources/css/app.css', 'public/assets/css/app.css');
    mix.copy('resources/css/demo.css', 'public/assets/css/demo.css');
    mix.copy('resources/css/intlTelInput.css', 'public/assets/css/intlTelInput.css');
    mix.copy('resources/css/app-admin.css', 'public/assets_admin/css/app.css');
    mix.copy('resources/css/app-pharmacy.css', 'public/assets_pharmacy/css/app.css');
    mix.copy('resources/js/map.js', 'public/assets/js/map.js');
    mix.copy('resources/js/app.js', 'public/assets/js/app.js');
    mix.copy('resources/js/utils.js', 'public/assets/js');
    mix.copy('resources/js/app-admin.js', 'public/assets_admin/js/app.js');
    mix.copy('resources/js/app-pharmacy.js', 'public/assets_pharmacy/js/app.js');
    mix.copy('resources/css/feather.css', 'public/assets/libs/feather/feather.css');
    mix.copy('resources/css/feather.css', 'public/assets_admin/libs/feather/feather.css');
    mix.copy('resources/css/feather.css', 'public/assets_pharmacy/libs/feather/feather.css');
    mix.copy('resources/fonts/fonts', 'public/assets/libs/fonts');
    mix.copy('resources/fonts/fonts-admin', 'public/assets_admin/libs/fonts');
    mix.copy('resources/fonts/fonts-pharmacy', 'public/assets_pharmacy/libs/fonts');
    mix.copy('resources/js/pages-admin', 'public/assets_admin/js/pages');
    mix.copy('resources/js/pages-pharmacy', 'public/assets_pharmacy/js/pages');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.css', 'public/assets/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.css.map', 'public/assets/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/assets/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css.map', 'public/assets/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/assets/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js.map', 'public/assets/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/assets/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js.map', 'public/assets/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.css', 'public/assets_admin/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.css.map', 'public/assets_admin/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/assets_admin/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css.map', 'public/assets_admin/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/assets_admin/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js.map', 'public/assets_admin/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/assets_admin/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js.map', 'public/assets_admin/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.css', 'public/assets_pharmacy/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.css.map', 'public/assets_pharmacy/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/assets_pharmacy/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css.map', 'public/assets_pharmacy/libs/bootstrap/css');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/assets_pharmacy/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js.map', 'public/assets_pharmacy/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/assets_pharmacy/libs/bootstrap/js');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js.map', 'public/assets_pharmacy/libs/bootstrap/js');
    mix.copy('node_modules/@fortawesome/fontawesome-free/css', 'public/assets/libs/fontawesome/css');
    mix.copy('node_modules/@fortawesome/fontawesome-free/js', 'public/assets/libs/fontawesome/js');
    mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/assets/libs/fontawesome/webfonts');
    mix.copy('node_modules/@fortawesome/fontawesome-free/css', 'public/assets_admin/libs/fontawesome/css');
    mix.copy('node_modules/@fortawesome/fontawesome-free/js', 'public/assets_admin/libs/fontawesome/js');
    mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/assets_admin/libs/fontawesome/webfonts');
    mix.copy('node_modules/@fortawesome/fontawesome-free/css', 'public/assets_pharmacy/libs/fontawesome/css');
    mix.copy('node_modules/@fortawesome/fontawesome-free/js', 'public/assets_pharmacy/libs/fontawesome/js');
    mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/assets_pharmacy/libs/fontawesome/webfonts');
    mix.copy('node_modules/datatables.net/js/jquery.dataTables.min.js', 'public/assets_pharmacy/libs/datatables/js');
     mix.copy('node_modules/datatables.net/js/jquery.dataTables.min.js', 'public/assets_admin/libs/datatables/js');
    mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/assets_admin/libs/jquery/jquery.min.js');
    mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/assets_pharmacy/libs/jquery/jquery.min.js');
    mix.copy('node_modules/feather-icons/dist/feather.min.js', 'public/assets/libs/feather/feather.min.js');
    mix.copy('node_modules/feather-icons/dist/feather.min.js.map', 'public/assets/libs/feather/feather.min.js.map');
    mix.copy('node_modules/slick-carousel-latest/slick/slick.js', 'public/assets/js/slick.js');
    mix.copy('node_modules/theia-sticky-sidebar/dist', 'public/assets/libs/theia-sticky-sidebar/dist');
    mix.copy('node_modules/select2/dist', 'public/assets/libs/select2/dist');
    mix.copy('node_modules/select2/dist', 'public/assets_admin/libs/select2/dist');
    mix.copy('node_modules/select2/dist', 'public/assets_pharmacy/libs/select2/dist');
    mix.copy('node_modules/moment/min/moment.min.js', 'public/assets/js');
    mix.copy('node_modules/moment/min/moment.min.js.map', 'public/assets/js');
    mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.css', 'public/assets/libs/daterangepicker/daterangepicker.css');
    mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.js', 'public/assets/libs/daterangepicker/daterangepicker.js');
    mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/assets/js');
    mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 'public/assets/css');
    mix.copy('node_modules/jquery-ui-bundle.1.12.1/jquery-ui.min.js', 'public/assets/js');
    mix.copy('node_modules/jquery-ui-bundle.1.12.1/jquery-ui.min.css', 'public/assets/css');
    mix.copy('node_modules/fullcalendar/dist/fullcalendar.min.js', 'public/assets/libs/fullcalendar');
    mix.copy('node_modules/fullcalendar/dist/fullcalendar.min.css', 'public/assets/libs/fullcalendar');
    mix.copy('node_modules/@fancyapps/fancybox/dist', 'public/assets/libs/fancybox');
    mix.copy('node_modules/jquery-circle-progress/dist/circle-progress.min.js', 'public/assets/js');
    mix.copy('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css', 'public/assets/libs/bootstrap-tagsinput');
    mix.copy('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.js', 'public/assets/libs/bootstrap-tagsinput');
    mix.copy('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js', 'public/assets/libs/bootstrap-tagsinput');
    mix.copy('node_modules/dropzone/dist', 'public/assets/libs/dropzone');
    mix.copy('node_modules/aos/dist', 'public/assets/libs/aos');
    mix.copy('node_modules/owl.carousel/dist/owl.carousel.min.js', 'public/assets/js');
    mix.copy('node_modules/owl.carousel/dist/owl.carousel.min.js', 'public/assets_admin/js');
    mix.copy('node_modules/owl.carousel/dist/assets/owl.carousel.min.css', 'public/assets_admin/css');
    mix.copy('node_modules/owl.carousel/dist/assets/owl.carousel.min.css', 'public/assets/css');
    mix.copy('node_modules/apexcharts/dist/apexcharts.css', 'public/assets/libs/apex');
    mix.copy('node_modules/apexcharts/dist/apexcharts.min.js', 'public/assets/libs/apex');
    mix.copy('node_modules/jquery-slimscroll/jquery.slimscroll.js', 'public/assets_admin/libs/slimscroll');
    mix.copy('node_modules/jquery-slimscroll/jquery.slimscroll.min.js', 'public/assets_admin/libs/slimscroll');
    mix.copy('node_modules/jquery-slimscroll/jquery.slimscroll.js', 'public/assets_pharmacy/libs/slimscroll');
    mix.copy('node_modules/jquery-slimscroll/jquery.slimscroll.min.js', 'public/assets_pharmacy/libs/slimscroll');
    mix.copy('node_modules/feather-icons/dist/feather.min.js', 'public/assets_admin/libs/feather/feather.min.js');
    mix.copy('node_modules/feather-icons/dist/feather.min.js.map', 'public/assets_admin/libs/feather/feather.min.js.map');
    mix.copy('node_modules/moment/min/moment.min.js', 'public/assets_admin/js');
    mix.copy('node_modules/moment/min/moment.min.js.map', 'public/assets_admin/js');
    mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.css', 'public/assets_admin/libs/daterangepicker/daterangepicker.css');
    mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.js', 'public/assets_admin/libs/daterangepicker/daterangepicker.js');
    mix.copy('node_modules/apexcharts/dist/apexcharts.css', 'public/assets_admin/libs/apex');
    mix.copy('node_modules/apexcharts/dist/apexcharts.min.js', 'public/assets_admin/libs/apex');
    mix.copy('node_modules/jquery.maskedinput/src/jquery.maskedinput.js', 'public/assets_admin/js');
    mix.copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'public/assets_admin/libs/datatables/css/datatables.min.css');
    mix.copy('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'public/assets_admin/libs/datatables/js/datatables.min.js');
    mix.copy('node_modules/feather-icons/dist/feather.min.js', 'public/assets_pharmacy/libs/feather/feather.min.js');
    mix.copy('node_modules/feather-icons/dist/feather.min.js.map', 'public/assets_pharmacy/libs/feather/feather.min.js.map');
    mix.copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'public/assets_pharmacy/libs/datatables/css/datatables.min.css');
    mix.copy('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'public/assets_pharmacy/libs/datatables/js/datatables.min.js');
    mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.css', 'public/assets_pharmacy/libs/daterangepicker/daterangepicker.css');
    mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.js', 'public/assets_pharmacy/libs/daterangepicker/daterangepicker.js');
    mix.copy('node_modules/apexcharts/dist/apexcharts.css', 'public/assets_pharmacy/libs/apex');
    mix.copy('node_modules/apexcharts/dist/apexcharts.min.js', 'public/assets_pharmacy/libs/apex');
    mix.copy('node_modules/moment/min/moment.min.js', 'public/assets_pharmacy/js');
    mix.copy('node_modules/moment/min/moment.min.js.map', 'public/assets_pharmacy/js');
    mix.copy('node_modules/morris.js/morris.js', 'public/assets_pharmacy/libs/morris');
    mix.copy('node_modules/morris.js/morris.min.js', 'public/assets_pharmacy/libs/morris');
    mix.copy('node_modules/morris.js/morris.css', 'public/assets_pharmacy/libs/morris');
    mix.copy('node_modules/swiper/css/swiper.min.css', 'public/assets/libs/swiper/css');
    mix.copy('node_modules/swiper/js/swiper.min.js', 'public/assets/libs/swiper/js');
    mix.copy('node_modules/swiper/js/swiper.min.js.map', 'public/assets/libs/swiper/js');
    mix.copy('node_modules/intl-tel-input/build/js/intlTelInput.js', 'public/assets/js');
    mix.copy('node_modules/intl-tel-input/build/js/intlTelInput.min.js', 'public/assets/js');

    //copying demo pages related assets
    var app_pages_assets = {
        js: [

            folder.src + "js/pages/slick.init.js",
            folder.src + "js/pages/select.init.js",
            folder.src + "js/pages/daterangepicker.init.js",
            folder.src + "js/pages/datetimepicker.init.js",
            folder.src + "js/pages/fullcalendar.init.js",
            folder.src + "js/pages/progress-bar.init.js",
            folder.src + "js/pages/dropzone.init.js",
            folder.src + "js/pages/profile-settings.init.js",
        ]
    };

    var out = folder.dist_assets + "js/";
    lodash(app_pages_assets).forEach(function (assets, type) {
        for (let i = 0; i < assets.length; ++i) {
            mix.js(assets[i], out + "pages");
        };
    });


