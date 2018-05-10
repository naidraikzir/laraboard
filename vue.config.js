module.exports = {
  outputDir: '/public/dist',
  css: {
    extract: {
      filename: 'css/app.css',
    },
  },
  devServer: {
    port: 9001,
  },
  chainWebpack: config => {
    config
      .entry('dashboard')
      .add('./resources/assets/js/dashboard.js')
      .end();

    config.entryPoints.delete('app');

    config.output
      .publicPath('http://localhost:9001/');

    if (process.env.NODE_ENV === 'production') {
      config.output
        .publicPath('/dist/')
        .filename('js/[name].js')
        .chunkFilename('js/[name].[chunkhash].js');
    }

    config.resolve.extensions
      .add('.js')
      .add('.vue')
      .add('.scss')
      .end();

    config.resolve.modules
      .add(__dirname + '/resources/assets/')
      .end();

    config.plugins.delete('html');
  },
};
