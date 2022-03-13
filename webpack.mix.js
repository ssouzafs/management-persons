const mix = require('laravel-mix');
mix
    .sass('resources/views/assets/scss/reset.scss', 'public/site/assets/css/reset.css')
    .sass('resources/views/assets/scss/boot.scss', 'public/site/assets/css/boot.css')
    .sass('resources/views/assets/scss/area-access-user.scss', 'public/site/assets/css/area-access.css')
    .sass('resources/views/assets/scss/style-user.scss', 'public/site/assets/css/style-user.css')

    .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/site/assets/css/bootstrap.css')

    .scripts([
        'node_modules/jquery/dist/jquery.js',
        'resources/views/assets/js/jquery-ui.js'
    ], 'public/site/assets/js/jquery.js')

    .scripts([
        'resources/views/assets/js/login.js'
    ], 'public/site/assets/js/login.js')

    .scripts([
        'resources/views/assets/js/register.js'
    ], 'public/site/assets/js/register.js')

    .scripts([
        'resources/views/assets/js/scripts.js'
    ], 'public/site/assets/js/scripts.js')

    .scripts(['node_modules/bootstrap/dist/js/bootstrap.bundle.js'], 'public/site/assets/js/bootstrap.js')

    .scripts([
        'resources/views/assets/js/datatables/js/jquery.dataTables.min.js',
        'resources/views/assets/js/datatables/js/dataTables.responsive.min.js',
        'resources/views/admin/assets/js/jquery.form.js',
        'resources/views/assets/js/jquery.mask.js',
    ], 'public/site/assets/js/libs.js')

    .copyDirectory('resources/views/assets/css/fonts', 'public/site/assets/css/fonts')

    .copyDirectory('resources/views/assets/images', 'public/site/assets/images')

    /** Area Administrativa */

    .styles([
        'resources/views/admin/assets/js/datatables/css/jquery.dataTables.min.css',
        'resources/views/admin/assets/js/datatables/css/responsive.dataTables.min.css',
    ], 'public/adm/assets/css/libs.css')

    .scripts([
        'resources/views/admin/assets/js/datatables/js/customDataTables.js'
    ], 'public/adm/assets/js/datatables/js/customDataTables.js')

    .sass('resources/views/admin/assets/scss/reset.scss', 'public/adm/assets/css/reset.css')
    .sass('resources/views/admin/assets/scss/boot.scss', 'public/adm/assets/css/boot.css')
    .sass('resources/views/admin/assets/scss/login.scss', 'public/adm/assets/css/login.css')
    .sass('resources/views/admin/assets/scss/style.scss', 'public/adm/assets/css/style.css')

    .scripts([
        'resources/views/admin/assets/js/scripts.js'
    ], 'public/adm/assets/js/scripts.js')

    .scripts([
        'resources/views/admin/assets/js/login.js'
    ], 'public/adm/assets/js/login.js')

    .options({
        processCssUrls: false
    })
    .version();
