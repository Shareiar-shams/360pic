const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .styles([
        'public/userViewport/assets/css/plugin/meanmenu.min.css',
        'public/userViewport/assets/css/plugin/owl.carousel.min.css',
        'public/userViewport/assets/css/plugin/owl.theme.default.min.css',
        'public/userViewport/assets/css/style.css',
        'public/userViewport/assets/css/responsive.css', 
        'public/userViewport/assets/css/plugin/daterangepicker.css'],
        'public/user/all.css')
        .scripts([
            'public/userViewport/assets/js/jquery-3.4.1.min.js',
            'public/userViewport/assets/js/plugin/jquery.meanmenu.min.js',
            'public/userViewport/assets/js/plugin/owl.carousel.min.js',
            'public/userViewport/assets/js/plugin/jquery.toTop.min.js',
            'public/userViewport/assets/js/custom.js',
            'public/userViewport/assets/js/plugin/moment.min.js',
            'public/userViewport/assets/js/plugin/daterangepicker.js',
            'public/userViewport/assets/js/step.js'
        ],
        'public/user/all.js');

mix.styles([
        'public/userDashboard/assets/css/bootstrap.min.css',
        'public/userDashboard/assets/css/font-awesome.min.css',
        'public/userDashboard/assets/css/themify-icons.css',
        'public/userDashboard/assets/css/metisMenu.css',
        'public/userDashboard/assets/css/owl.carousel.min.css',
        'public/userDashboard/assets/css/slicknav.min.css',
        'public/userDashboard/assets/css/typography.css',
        'public/userDashboard/assets/css/default-css.css',
        'public/userDashboard/assets/css/styles.css',
        'public/userDashboard/assets/css/responsive.css'], 
        'public/userpanel/all.css')
        .scripts([
            'public/userDashboard/assets/js/vendor/jquery-2.2.4.min.js',
            'public/userDashboard/assets/js/popper.min.js',
            'public/userDashboard/assets/js/bootstrap.min.js',
            'public/userDashboard/assets/js/owl.carousel.min.js',
            'public/userDashboard/assets/js/metisMenu.min.js',
            'public/userDashboard/assets/js/jquery.slimscroll.min.js',
            'public/userDashboard/assets/js/jquery.slicknav.min.js',
            'public/userDashboard/assets/js/line-chart.js',
            'public/userDashboard/assets/js/bar-chart.js',
            'public/userDashboard/assets/js/pie-chart.js',
            'public/userDashboard/assets/js/plugins.js',
            'public/userDashboard/assets/js/scripts.js',
            'public/userDashboard/assets/js/vendor/modernizr-2.8.3.min.js'
        ],
        'public/userpanel/all.js');

// mix.styles([
//         'public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css',
//         'public/admin/bower_components/font-awesome/css/font-awesome.min.css',
//         'public/admin/bower_components/Ionicons/css/ionicons.min.css',
//         'public/admin/dist/css/AdminLTE.min.css',
//         'public/admin/dist/css/skins/_all-skins.min.css',
//         'public/admin/bower_components/morris.js/morris.css',
//         'public/admin/bower_components/jvectormap/jquery-jvectormap.css',
//         'public/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
//         'public/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css',
//         'public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
//         'public/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
//         'public/admin/plugins/iCheck/flat/blue.css',
//         'public/admin/plugins/iCheck/square/blue.css',
//         'public/admin/bower_components/select2/dist/css/select2.min.css'
//         ], 
//         'public/admin/all.css')
//         .scripts([
//             'public/admin/bower_components/jquery/dist/jquery.min.js',
//             'public/admin/bower_components/jquery-ui/jquery-ui.min.js',
//             'public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js',
//             'public/admin/bower_components/raphael/raphael.min.js',
//             'public/admin/bower_components/morris.js/morris.min.js',
//             'public/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js',
//             'public/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
//             'public/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
//             'public/admin/bower_components/chart.js/Chart.js',
//             'public/admin/bower_components/jquery-knob/dist/jquery.knob.min.js',
//             'public/admin/bower_components/moment/min/moment.min.js',
//             'public/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js',
//             'public/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
//             'public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
//             'public/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
//             'public/admin/bower_components/fastclick/lib/fastclick.js',
//             'public/admin/dist/js/adminlte.min.js',
//             'public/admin/dist/js/pages/dashboard.js',
//             'public/admin/dist/js/demo.js',
//             'public/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
//             'public/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
//             'public/admin/plugins/iCheck/icheck.min.js',
//             'public/admin/bower_components/select2/dist/js/select2.full.min.js'
//         ],
//         'public/admin/all.js');