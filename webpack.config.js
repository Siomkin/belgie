var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    // .autoProvideVariables({
    //     "window.Bloodhound": require.resolve('bloodhound-js'),
    //     "jQuery.tagsinput": "bootstrap-tagsinput"
    // })
    .enableSassLoader()
    .enableVersioning()
    .addEntry('js/app', './assets/bootstrap/js/bootstrap.min.js')
    .addStyleEntry('css/app',
        ['./assets/bootstrap/css/bootstrap.min.css', './assets/css/non-responsive.css', './assets/css/style.css'])
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
;

module.exports = Encore.getWebpackConfig();